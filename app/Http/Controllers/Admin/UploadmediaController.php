<?php
namespace App\Http\Controllers\Admin;
use App\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Image;
use Video;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class UploadmediaController extends Controller
{
    private $photos_path;
    public function __construct()
    {

        //$this->middleware('auth');

//        $this->middleware('auth');

    }
    public function index(){
        
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Media Upload",URL::to('/admin/upload-media'));
        //This is for breadcrumb
        
        $data = array();
        $data['media_category'] = DB::table('media_category')->where('status','1')->get();
        return view('Admin.media.Upload_media')->with($data);
    }
    
    public function upload(Request $request){
        
        
        $result = array();
        $result['status'] = 0;
        $insert_data = array();
        if($request->input('mediatype') == 1 && $request->input('media_category') != 0){
            $image = $request->file('file');
            $filename  = basename($image->getClientOriginalName());
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $destinationPath = public_path().'/upload/image/thumbnail/';
            $uniquesavename = time().uniqid(rand());
            $destFile = $uniquesavename . '.'.$extension;
            $input['media_name'] = $destFile;
            $img = Image::make($image->getRealPath())->resize(500, 500);
            $img->save($destinationPath.'/'.$input['media_name']);
            

            $destinationPath = public_path().'/upload/image/';
            
            $destFile = $uniquesavename . '.'.$extension;
            
           // $upload_success = $image->move(public_path('upload/image'),$imageName);

            if($image->move($destinationPath,$destFile)){
                $insert_data['media_category'] = $request->input('media_category');
                $insert_data['media_type'] = $request->input('mediatype');
                $insert_data['media_name'] = $destFile;
                $insert_data['media_url'] = '';
                $insert_data['status'] = 1;
                
                $insert_data['created_at'] = date('y-m-d h:i:s');
                $insert_data['updated_at'] = date('y-m-d h:i:s');
               $insert_id = DB::table('media')->insertGetId($insert_data);
                $result['status'] = 1;
                $result['id'] = $insert_id;
                $result['msg'] = 'Image Uploaded';
                //return response()->json($upload_success, 200);
            }
            // Else, return error 400
            else {
                return response()->json('error', 400);
            }
        
        }
        else{
            
        }
        return response()->json($result);
    }
    public function videoupload(Request $request){
        $result = array();
        $result['status'] = 0;
        $inser_data = array();
        $video = $request->file('file');
        if(isset($video) && $video != ''){
            $filename = basename($video->getClientOriginalName());
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
             $destinationPath = public_path().'/upload/video/';
             $uniquesavename = time().uniqid(rand());   
            $destFile = $uniquesavename . '.'.$extension;
        
            if($video->move($destinationPath,$destFile)){
                $insert_data['media_category'] = $request->input('media_category');
                $insert_data['media_type'] = $request->input('media_type');
                $insert_data['media_name'] = $destFile;
                $insert_data['media_url'] = '';
                $insert_data['status'] = 1;
                $insert_data['created_at'] = date('y-m-d h:i:s');
                $insert_data['updated_at'] = date('y-m-d h:i:s');
                $insert_id = DB::table('media')->insertGetId($insert_data);
                if(isset($insert_id) && $insert_id != ''){
                    $result['status'] = 1;
                    $result['msg'] = 'Video Uploaded';
                }
            }
        }
        else {
            $insert_data['media_category'] = $request->input('media_category');
            $insert_data['media_type'] = $request->input('media_type');
            $insert_data['media_name'] = '';
            $insert_data['media_url'] = $request->input('media_url');
            $insert_data['status'] = 1;
            $insert_data['created_at'] = date('y-m-d h:i:s');
            $insert_data['updated_at'] = date('y-m-d h:i:s');
            $insert_id = DB::table('media')->insertGetId($insert_data);
            if(isset($insert_id) && $insert_id != ''){
                $result['status'] = 1;
                $result['msg'] = 'Video Uploaded';
            }
        }
        return response()->json($result); 
    }
    public function getdatatable(){
        $requestData = $_REQUEST;

        $data = array();

        $select_query = DB::table('media as ml');
        $select_query->join('media_category as mc','ml.media_category','=','mc.id');
        $select_query->select('ml.*','mc.category_name');
        //This is for search value
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("ml.media_name","like",'%'.$requestData['search']['value'].'%')
                         ->orwhere("mc.category_name","like",'%'.$requestData['search']['value'].'%');
                    
        }

        //This is for order 
        $columns = array(
            0. => 'ml.id',
            1 => 'ml.media_name',
            2 => 'mc.category_name',
            3 => 'ml.media_name',
            4 => 'ml.media_type',
            
        );
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("ml.id","DESC");
        }
        
        //This is for count
        
        $result= $select_query->count();
        $totalData = 0;
        $totalFiltered = 0;
        if ($result > 0) {
            $totalData = $result;
            $totalFiltered = $result;
        }

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $service_price_list = $select_query->get();
        $arr_data = Array();
        $arr_data = $result;

        $baseurl = url('/');
        foreach ($service_price_list as $row) {
            
            $temp['id'] = $row->id;
            if ($row->media_type == '1'){
            $media = "<div> <img src='".$baseurl."/upload/image/thumbnail/".$row->media_name."' style='height:100px;' /></div>";
            $mediatype = "Image";
            }
            else{
            $media = "<video controls='' width='150'><source src='".$baseurl."/upload/video/".$row->media_name."' id='video_here'>Your browser does not support HTML5 video.</video>";    
            $mediatype = "Video";
            }
            $temp['media_image'] = $media;
            if(isset($row->media_name) && $row->media_name != ''){
                $media_name = $row->media_name;
            }
            else{
                $media_name = $row->media_url;
            }
            $temp['media_name'] = $media_name;
            $temp['media_type'] = $mediatype;
            $temp['category_name'] = $row->category_name;
            $id = $row->id;
            
            
            $action = '<div class="datatable_btn">';
            //<a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
                
            $action .= '<a data-id="'.$id.'" data-mediatype="'.$row->media_type.'" class="btn btn-xs btn-danger btnDeleteMediaUploded"> Delete</a></div>';
            
            $temp['action'] = $action;
            $data[] = $temp;
            $id = "";
        }



        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
            
        );
        echo json_encode($json_data);
        exit(0);
        
    }
    public function delete_media(Request $request){
        $result = array();
        $result['status'] = 0;
        $media_id = $request->input('media_id');
        $image = DB::table('media')->where('id', $media_id)->first();
        $file = $image->media_name;
        if($request->input('mediatype') == 1){
            $filename_thum = public_path().'/upload/image/thumbnail/'.$file;
             File::delete($filename_thum);
            $filename = public_path().'/upload/image/'.$file;
        }
        else{
            $filename = public_path().'/upload/video/'.$file;
        }
         File::delete($filename);
         
       if(DB::table('media')->delete($media_id)){
           
           $result['status'] = 1;
           $result['msg'] = "Record Deleted..";
       }
       echo json_encode($result);

    }
}