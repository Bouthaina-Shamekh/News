<?php

namespace App\Jobs;


use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;


class ConvertVideoToHLS implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $timeout = 7200;

    public function __construct(public Video $video) {}

    public function handle(): void
    {
        $this->video->refresh();

        $inputPath  = $this->video->vedio; // مسار الملف الأصلي
        $outputDir  = 'videos/hls/' . $this->video->id;

        if (! $inputPath || ! Storage::disk('public')->exists($inputPath)) {
            $this->video->update(['status' => 'failed']);
            return;
        }

        Storage::disk('public')->deleteDirectory($outputDir);

        $media = FFMpeg::fromDisk('public')->open($inputPath);
        $height = null;

        try {
            $stream = $media->getVideoStream();
            if ($stream) {
                $dimensions = $stream->getDimensions();
                $height = $dimensions ? $dimensions->getHeight() : null;
            }
        } catch (\Throwable $e) {
            $height = null;
        }

        $maxHeight = $height ?: 720;
        $profiles = [
            ['height' => 1080, 'bitrate' => 3000],
            ['height' => 720, 'bitrate' => 1500],
            ['height' => 480, 'bitrate' => 900],
            ['height' => 360, 'bitrate' => 500],
        ];

        $profiles = array_values(array_filter($profiles, function ($profile) use ($maxHeight) {
            return $profile['height'] <= $maxHeight;
        }));

        if (! $profiles) {
            $profiles = [[
                'height' => (int) $maxHeight,
                'bitrate' => 300,
            ]];
        }

        $export = $media
            ->exportForHLS()
            ->onProgress(function ($percentage) {
                // ممكن تحدّث DB هنا لو بدك progress bar
            });

        foreach ($profiles as $profile) {
            $export->addFormat((new X264)->setKiloBitrate($profile['bitrate']), function ($media) use ($profile) {
                $media->scale(-2, $profile['height']);
            });
        }

        $export->toDisk('public')->save($outputDir . '/master.m3u8');

        $masterPlaylist = $outputDir . '/master.m3u8';
        if (Storage::disk('public')->exists($masterPlaylist)) {
            $contents = Storage::disk('public')->get($masterPlaylist);
            $contents = preg_replace('/\R?#EXT-X-ENDLIST\R?/', PHP_EOL, $contents);
            Storage::disk('public')->put($masterPlaylist, trim($contents) . PHP_EOL);
        }

        // حدّث DB بمسار الـ HLS
        $this->video->update([
            'hls_path' => $masterPlaylist,
            'status'   => 'ready',
        ]);
    }
}
