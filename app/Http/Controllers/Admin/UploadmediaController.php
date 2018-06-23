<?php
namespace App\Http\Controllers\Admin;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Image;

class UploadmediaController extends Controller
{
    private $photos_path;
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('Admin.media.Upload_media');
    }
    
    public function upload(Request $request){

    }
}