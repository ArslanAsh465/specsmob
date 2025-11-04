<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Brand;

class SidebarAllBrands extends Component
{
    public $brands;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->brands = Brand::where('status', 1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-all-brands');
    }
}
