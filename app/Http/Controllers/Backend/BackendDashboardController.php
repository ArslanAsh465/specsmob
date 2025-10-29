<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendDashboardController extends Controller
{
    protected $data = [];
    
    public function dashboard()
    {
        $this->data['title'] = 'Dashboard';

        return view('backend.dashboard', $this->data);
    }
}
