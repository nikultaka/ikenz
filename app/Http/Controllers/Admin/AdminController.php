<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
        public function __construct()
        {
            $this->middleware('auth');
        }
        public function admin(Request $request)
        {
            if ($request->isMethod('post')) {
                $post = $request->input();
                echo "<pre>";
                print_r($post);exit;
                
            }
            return view('admin.login');
        }
}
