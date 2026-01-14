<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Check if the current route is for admin pages
        if (request()->is('admin/*')) {
            return view('layouts.master');
        }

        return view('layouts.app');
    }
}
