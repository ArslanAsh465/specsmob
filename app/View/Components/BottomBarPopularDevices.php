<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Mobile;

class BottomBarPopularDevices extends Component
{
    public $mobiles;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->mobiles = Mobile::where('status', 1)->orderByDesc('views')->take(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bottom-bar-popular-devices');
    }
}
