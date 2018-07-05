<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use Image;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class TestimonialController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
    }
    
    public function index()
    {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Testimonial",URL::to('/admin/testimonial'));
        //This is for breadcrumb
        
        return view("admin.testimonial.testimonial_list");
        
    }
    
    public function addrecord(Request $request){
        
        $data_insert=array();
        $result=array();
        $result['status']=0;
        
        $post = $request->input();
        
        if(!empty($post)){
            if(isset($post['id'])){
                $id_test = $post['id'];
            }
            $filename  = basename($_FILES['user_photo']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $testimonialObj = new Testimonial($request->input());
            $uniquesavename=time().uniqid(rand());
          
               
            if($file = $request->hasFile('user_photo')) {

                $file = $request->file('user_photo') ;
                $input['user_photo'] = time().'.'.$file->getClientOriginalExtension();


                $destinationPath = public_path().'/upload/testimonial/thumbnail';
                $img = Image::make($file->getRealPath());
                $destFile = $uniquesavename . '.'.$extension;
                $input['user_photo'] = $destFile;
                $img = Image::make($file->getRealPath())->resize(100, 100);

//                $img->fit(100,100, function ($constraint) {
//                    $constraint->aspectRatio();        
//                });
                $img->save($destinationPath.'/'.$input['user_photo']);
//                $img = Image::make($file->getRealPath())->resize(500, 500);
//                echo $img;exit;


                $destinationPath = public_path().'/upload/testimonial/';
//                $uniquesavename=time().uniqid(rand());
//                $destFile = $uniquesavename . '.'.$extension;
                $file->move($destinationPath,$destFile);
                $testimonialObj->user_photo = $destFile;

             } else {
                 $testimonialObj->user_photo = isset($post['hdn_file'])?$post['hdn_file']:'';
             }
                $user_photo = $testimonialObj->user_photo;
                
                $data_insert = array();
                $data_insert['customer_name'] = isset($post['cus_name'])?$post['cus_name']:'';
                $data_insert['feedback'] = isset($post['feedback'])?$post['feedback']:'';
                $data_insert['user_photo'] = $user_photo;
                $data_insert['status'] = isset($post['status'])?$post['status']:'';

                 
            if(isset($post['id']) && $post['id'] != ''){
                
              $data_insert['updated_at']=date("Y-m-d h:i:s");
              
              $returnresult= DB::table('testimonial')
                 ->where('id',$id_test)     
                 ->update($data_insert);
              
              if($returnresult){
                  $result['status']=1;
                  $result['msg']='Record updated successfully.!';
              }
            }      
            else{

                $data_insert['created_at']=date("Y-m-d h:i:s");
                if(DB::table('testimonial')->insert($data_insert)){
                    $result['status']=1;
                    $result['msg']="Record add sucessfully..!";
                }
            }
            echo json_encode($result);
            exit;
                 
        }
    }
        
    
    public function edittestimonial(Request $request){
     
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

            $testimonial = DB::table('testimonial')
                    ->where('id','=',$id)->first();
        
            $data_result['status'] = 1;
            $data_result['content'] = $testimonial;
            }
        }
        echo json_encode($data_result);
        exit;
        
        
        
        
    }
    
    public function deleterecord(Request $request){

        $post = $request->input();
        $data_result=array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

                DB::table('testimonial')
                    ->where('id', $id)
                    ->update(array('status'=>-1));

                $data_result['status']=1;
                $data_result['msg']="Record deleted successfully.";
            }
        }
        echo json_encode($data_result);
        exit;
        
    }
        
    public function anyData(){
        
        $requestData = $_REQUEST;

        $data = array();
        
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'customer_name',
            2 => 'feedback',
            3 => 'user_photo',
            4 => 'status',
            5 => 'created_at',
            5 => 'updated_at',
        );
        
        $select_query = DB::table('testimonial')
                        ->where('status','!=',-1);
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("customer_name","like",'%'.$requestData['search']['value'].'%');
        }
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("id","DESC");
        }
        
        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $testimonial_list = $select_query->get();
        
        $baseurl = url('/');
        foreach ($testimonial_list as $row) {
            
            $file = public_path()."/upload/testimonial/thumbnail/".$row->user_photo;
            
            if (file_exists($file)){
                $media="<div> <img src='".$baseurl."/upload/testimonial/thumbnail/".$row->user_photo."'/></div>";
            } else {
                $media = "<div> <img src='".$baseurl."/images/noimage100.png'></div>";
            }
//            echo $media;exit;
            $temp['id'] = $row->id;
            $temp['customer_name'] = $row->customer_name;
            $temp['feedback'] = $row->feedback;
            $temp['user_photo'] = $media;
            $temp['created_date'] = $row->created_at;
            $temp['updated_date'] = $row->updated_at;
            $temp['status'] = $row->status;
            $id = $row->id;
            
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_test"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-danger btnDelete_test"> Delete</a></div>';
            
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
    
    
    
    
}
