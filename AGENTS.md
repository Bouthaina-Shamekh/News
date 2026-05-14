## Stack
- Laravel 10 on PHP 8.1 with Vite 4.
- Use `npm`, not `pnpm` or `yarn` (`package-lock.json` is committed).

## Setup And Dev Commands
- Install PHP deps with `composer install`.
- Install frontend deps with `npm install`.
- Local app loop is usually: `php artisan serve`, `npm run dev`.
- Create the public storage symlink before testing uploads/media: `php artisan storage:link`.
- If you touch routes, config, or views and behavior looks stale, run `php artisan optimize:clear`. This repo has cached artifacts under `bootstrap/cache/` and compiled views under `storage/framework/views/`.

## Verification
- PHP tests: `php artisan test`.
- Run one test: `php artisan test --filter ExampleTest`.
- Format PHP with `vendor/bin/pint`.
- Frontend verification is just `npm run build`; there are no repo scripts for lint/typecheck.
- The test suite is still basically Laravel's example tests, so feature changes usually need manual verification in the browser.

## App Structure
- `routes/web.php` is only the aggregator. Real web route files are `routes/site.php`, `routes/dashboard.php`, and `routes/publisher.php`.
- The app has three surfaces:
  - public localized site: `site.*`
  - admin dashboard: `dashboard.*`
  - publisher area: `publisher.*`
- `routes/api.php` is minimal; most behavior is server-rendered Blade + web routes.
- The Vite entrypoints are only `resources/css/app.css`, `resources/sass/app.scss`, and `resources/js/app.js`.
- A lot of dashboard UI comes from static assets in `public/assets-dashboard/`; do not assume everything is driven by Vite source files.

## Public Site Frontend Notes
- Public site views live in `resources/views/site/` and normally render through the Blade component `<x-site-layout>`, which resolves to `resources/views/layouts/site-layout.blade.php`.
- `site-layout.blade.php` includes `layouts.partials.site.head`, `header`, the global news ticker, optional page header slot (`$header`), the page slot, `footer`, and `end`.
- The public frontend is mostly static Blade + Bootstrap/jQuery-era assets, not Vite-driven. Main public assets are loaded from `public/assets-new/`, with some newer media pages also loading CSS from `public/assets/css/`.
- Global public CSS/JS loading is centralized in `resources/views/layouts/partials/site/head.blade.php` and `end.blade.php`. Page-specific styles are usually added with `@push('styles')`; page scripts with `@push('scripts')`.
- The current site markup is RTL-first: `head.blade.php` hardcodes `<html dir="rtl" lang="ar">`, many templates use inline `direction: rtl`, and CSS class names/layout assumptions are often RTL-oriented even when localized content uses English fields.
- Preserve locale-derived fields in site views: common dynamic field names are `title_{locale}`, `name_{locale}`, `text_{locale}`, `about_{locale}`, etc. Do not replace them with hardcoded Arabic or English fields unless a page already intentionally does so as a fallback.
- The main navigation, logo, publisher auth links, category dropdown, header ad, and search UI are in `layouts/partials/site/header.blade.php`. Its interactions depend on jQuery code in `public/assets-new/js/script.js` and Bootstrap collapse/dropdown classes.
- The footer and sticky social/back-to-top elements query `Setting` records directly from Blade in `footer.blade.php` and `end.blade.php`.
- The global news ticker is in `site-layout.blade.php` and uses `public/assets-new/assets_news_tricker/css/style_news_ticker.css` plus `public/assets-new/assets_news_tricker/js/news-ticker.js`. It duplicates ticker groups for seamless animation and changes direction based on locale.
- Listing pages like `news.blade.php` and `articles.blade.php` use `public/assets-new/css/news.css`; detail pages like `new.blade.php` and `article.blade.php` use `public/assets-new/css/new.css` and define custom meta through `@push('meta')` plus `@section('has_custom_meta', true)`.
- The home page (`site/home.blade.php`) is large and contains many page-specific sections, inline CSS, direct model queries, Bootstrap carousel markup, tabbed widgets, ads, podcasts, videos, and responsive overrides. Make minimal targeted edits there to avoid regressions.
- Video and podcast pages are newer custom layouts: `videos.blade.php`/`podcasts.blade.php` load `public/assets/css/videos-page.css` and `public/assets/css/podcasts.css`, while detail pages `video.blade.php`/`podcast.blade.php` load page-specific CSS and include custom media/player markup.
- Public frontend JS in `public/assets-new/js/script.js` handles search expansion, dropdown open/close, mobile navbar toggling, home tab switching, topbar date/time, weather widget injection, and Flatpickr initialization. Changes there can affect many public pages.
- Existing public templates contain many inline styles, direct model queries, duplicated markup, and Bootstrap 3 class patterns mixed with some Bootstrap 5-style data attributes. Prefer small, local fixes over broad refactors unless explicitly requested.
- When fixing public frontend issues, verify both desktop and mobile widths and start browser checks from locale-prefixed URLs such as `/ar/...`.

## Localization And Content Shape
- All web routes run through `mcamara/laravel-localization` middleware in `App\Http\Kernel`; route URLs are locale-prefixed.
- `/` redirects to the Arabic localized URL, so default browser checks should start from `/ar/...` behavior, not bare `/`.
- Supported locales are currently `ar` and `en` in `config/laravellocalization.php`.
- `AppServiceProvider` shares locale-derived field names like `name_{locale}`, `title_{locale}`, `description_{locale}` with views. When changing content models/views, preserve the `_ar` / `_en` column pattern.

## Auth And Guards
- Guard names are non-obvious in `config/auth.php`:
  - `web` uses the `Admin` model/provider.
  - `admin` uses the `User` model/provider.
  - `publisherGuard` uses the `Publisher` model/provider.
- Fortify is configured to use the `web` guard, so Fortify auth flows are for `Admin`, not the `admin` guard.
- Dashboard routes use `auth:admin` plus `check_user`; publisher routes use `auth:publisherGuard` plus `check_user` and `CheckStatusPublisher`.

## Media And Queue Gotchas
- Video upload/conversion is asynchronous. `Dashboard\VideoController` dispatches `App\Jobs\ConvertVideoToHLS` when a local video file is uploaded.
- For video features to work end-to-end, a queue worker must be running: `php artisan queue:work`.
- FFmpeg/FFprobe must be available through `FFMPEG_BINARIES` / `FFPROBE_BINARIES` or on `PATH` (`config/laravel-ffmpeg.php`).
- Uploaded source videos go to `storage/app/public/videos/originals`; generated HLS output goes to `storage/app/public/videos/hls/{id}/master.m3u8` and is served through `public/storage`.
- A `video_url` can bypass local upload/HLS conversion; do not assume every `Video` record has generated HLS files.

## Editing Boundaries
- Do not edit generated/cache artifacts in `storage/framework/views/` or `bootstrap/cache/`.
- Prefer editing Blade/templates and source PHP instead of compiled output.
