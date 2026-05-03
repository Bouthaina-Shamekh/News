<?php

namespace App\Jobs;


use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;


class ConvertVideoToHLS implements ShouldQueue
{
    public $timeout = 7200;

    public function __construct(public Video $video) {}

    public function handle(): void
    {
        $inputPath  = $this->video->original_path; // مسار الملف الأصلي
        $outputDir  = 'videos/hls/' . $this->video->id;

        FFMpeg::fromDisk('public')
            ->open($inputPath)
            ->exportForHLS()
            ->onProgress(function ($percentage) {
                // ممكن تحدّث DB هنا لو بدك progress bar
            })
            ->addFormat((new X264)->setKiloBitrate(500),  function($media) {
                $media->scale(640, 360);   // 360p
            })
            ->addFormat((new X264)->setKiloBitrate(1500), function($media) {
                $media->scale(1280, 720);  // 720p
            })
            ->addFormat((new X264)->setKiloBitrate(3000), function($media) {
                $media->scale(1920, 1080); // 1080p — احذفه لو الفيديو الأصلي أقل
            })
            ->toDisk('public')
            ->save($outputDir . '/master.m3u8');

        // حدّث DB بمسار الـ HLS
        $this->video->update([
            'hls_path' => $outputDir . '/master.m3u8',
            'status'   => 'ready',
        ]);
    }
}
