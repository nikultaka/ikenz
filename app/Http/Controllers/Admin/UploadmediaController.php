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

class UploadmediaController extends Controller
{
    private $photos_path;
     public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index(){
        return view('Admin.media.Upload_media');
    }
    
    public function upload(Request $request){
        
        
        $result=array();
        $result['status']=0;
        
            $image = $request->file('file');
            $filename  = basename($image->getClientOriginalName());
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
           // $imageName = time().$image->getClientOriginalName();
            //$input['media_name'] = time().'.'.$image->getClientOriginalExtension();


            $destinationPath = public_path().'/upload/image/thumbnail/';
            $uniquesavename=time().uniqid(rand());
            $destFile = $uniquesavename . '.'.$extension;
            $input['media_name'] = $destFile;
            $img = Image::make($image->getRealPath())->resize(500, 500);
            $img->save($destinationPath.'/'.$input['media_name']);
            

            $destinationPath = public_path().'/upload/image/';
            
            $destFile = $uniquesavename . '.'.$extension;
            
           // $upload_success = $image->move(public_path('upload/image'),$imageName);

            if($image->move($destinationPath,$destFile)){
                $input['gm_created']=date('y-m-d h:i:s');
                DB::table('media')->insert($input);
                $result['status'] = 1;
                $result['msg'] = 'Image Uploaded';
                //return response()->json($upload_success, 200);
            }
            // Else, return error 400
            else {
                return response()->json('error', 400);
            }
        
        
        return response()->json($result);
    }
    public function getdatatable(){
        $requestData = $_REQUEST;

        $data = array();

        $select_query = DB::table('media');
        $select_query->select('*');
        //This is for search value
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("media_name","like",'%'.$requestData['search']['value'].'%');
                    
        }

        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'media_name',
            
        );
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("id","DESC");
        }
        
        //This is for count
        $totalData = $select_query->count();
        
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

        $baseurl=url('/');
        foreach ($service_price_list as $row) {
            
            $temp['id'] = $row->id;
            $image="<div> <img src='".$baseurl."/upload/image/thumbnail/".$row->media_name."' style='height:100px;' /></div>";
            $temp['media_image']=$image;
            $temp['media_name'] = $row->media_name;
            
            $id = $row->id;
            
            
            $action = '<div class="datatable_btn">';
            //<a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
                
            $action .= '<a data-id="'.$id.'" class="btn btn-xs btn-danger btnDeleteMediaUploded"> Delete</a></div>';
            
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
        $result=array();
        $result['status']=0;
        $media_id=$request->input('media_id');
        $image = DB::table('media')->where('id', $media_id)->first();
        $file= $image->media_name;
        $filename = public_path().'/upload/image/'.$file;
         File::delete($filename);
         $filename_thum = public_path().'/upload/image/thumbnail/'.$file;
         File::delete($filename_thum);
       if(DB::table('media')->delete($media_id)){
           
           $result['status']=1;
           $result['msg']="Record Deleted..";
       }
       echo json_encode($result);
    }
}