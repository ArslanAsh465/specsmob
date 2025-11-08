<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Mobile;

class SidebarTopTenByUsersDevices extends Component
{
    public $mobiles;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->mobiles = Mobile::withCount([
            'comments as five_stars_count' => function ($q) {
                $q->where('status', true)->where('stars', 5);
            }
        ])
        ->having('five_stars_count', '>', 0)
        ->orderByDesc('five_stars_count')
        ->take(10)
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-top-ten-by-users-devices');
    }
}
