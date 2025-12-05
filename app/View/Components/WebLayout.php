<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WebLayout extends Component
{
    public $title;
    public $sidebar;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $sidebar)
    {
        $this->title = $title;
        $this->sidebar = $sidebar;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('web.layouts.app', [
            'title' => $this->title,
            'sidebar' => $this->sidebar,
        ]);
    }
}
