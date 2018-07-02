<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    //
    public function index()
    {
        CommonHelper::add_breadcrumb("Dashboard",URL::to('/admin/dashboard'));
        CommonHelper::add_breadcrumb("Add Dashboard",URL::to('/admin/dashboard/add'));
        
        return view("admin.dashboard");
    }
    
    
}
