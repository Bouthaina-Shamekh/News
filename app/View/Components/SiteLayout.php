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
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('layouts.site-layout');
    }
}
