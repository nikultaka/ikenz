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
//        $this->middleware('auth');
    }
    public function index(){
        return view('Admin.media.Upload_media');
    }
    
    public function upload(Request $request){

        echo '<pre>';
        print_r($_FILES);exit;
//        echo count($_FILES);
//        $temp_name = explode('.' , $_FILES['file']['name']);
//        print_r($temp_name);
////        $file = ($_FILES['name']);
////        echo count($temp_name);
//        exit;
         if($_FILES) {

                $file = $_FILES;
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                $destinationPath = public_path().'/upload/media/';
                $uniquesavename=time().uniqid(rand());
                $destFile = $uniquesavename . '.'.$extension;
                $file->move($destinationPath,$destFile);
//                $product->user_photo = $destFile;

             }

    }
}