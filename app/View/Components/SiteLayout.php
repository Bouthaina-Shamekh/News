<?php

namespace App\View\Components;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class SiteLayout extends Component
{
    public $title;
    public $sections;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null)
    {
        $this->title = $title ?? Config::get('app.name');
        $this->sections = Setting::where('key','sections_show')->first() ? json_decode(Setting::where('key','sections_show')->first()->value) : [];

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('layouts.site-layout', compact('setting', 'title_footer'));
    }
}
