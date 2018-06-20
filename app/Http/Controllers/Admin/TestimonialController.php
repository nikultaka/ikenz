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

class TestimonialController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $data_result=array();
        $test_list = Testimonial::where('status', '=', 1)->get();
        $data_result['test_list']=$test_list;
        return view("admin.testimonial.testimonial_list")->with($data_result);
        
    }
    
    public function addrecord(Request $request){
        
        $data_insert=array();
        $result=array();
        $result['status']=0;

        if($_POST){
            if($request->input('id_test')){
                $id_test = $request->input('id_test');
            }
            $filename  = basename($_FILES['user_photo']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            date_default_timezone_set("Asia/Kolkata");
            
             $product = new Testimonial($request->input()) ;
          
               
            if($file = $request->hasFile('user_photo')) {

                $file = $request->file('user_photo') ;
                $input['user_photo'] = time().'.'.$file->getClientOriginalExtension();


                $destinationPath = public_path().'/thumbnail';
                $img = Image::make($file->getRealPath());
                $img->fit(100,100, function ($constraint) {
                    $constraint->aspectRatio();        
                })->save($destinationPath.'/'.$input['user_photo']);


                $destinationPath = public_path().'/upload/';
                $uniquesavename=time().uniqid(rand());
                $destFile = $uniquesavename . '.'.$extension;
                $file->move($destinationPath,$destFile);
                $product->user_photo = $destFile ;

             }
                $cus_name = $request->input('cus_name');
                $feedback = $request->input('feedback');
                $user_photo = isset($destFile) ? $destFile : '';
                $status = $request->input('status');

             
                $data_insert = array();
                $data_insert['customer_name']=$cus_name;
                $data_insert['feedback']=$feedback;
                $data_insert['user_photo']=$user_photo;
                $data_insert['status']=$status;


                 
            if(isset($_POST['id_test']) && $_POST['id_test'] != ''){
              $data_insert['updated_date']=date("Y-m-d h:i:s");
              $returnresult= DB::table('testimonial')
                 ->where('id',$id_test)     
                 ->update($data_insert);
              if($returnresult){
                  $result['status']=1;
                  $result['msg']='Record updated successfully.!';
              }
                    
            }      
            else{

                $data_insert['created_date']=date("Y-m-d h:i:s");
                $data_insert['updated_date']=date("Y-m-d h:i:s");
                if(DB::table('testimonial')->insert($data_insert)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";

                    }
           
            }
            echo json_encode($result);
            exit;
                 
        }
    }
        
    
    public function edittestimonial(){
        $id=$_POST['test_id'];
        $charges =DB::table('testimonial')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$charges;
        $data_result['msg']="Record deleted successfully.";
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
            5 => 'created_date',
            5 => 'updated_date',
        );
        
        $select_query = DB::table('testimonial');
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
        foreach ($testimonial_list as $row) {
            $temp['id'] = $row->id;
            $temp['customer_name'] = $row->customer_name;
            $temp['feedback'] = $row->feedback;
            $temp['user_photo'] = $row->user_photo;
            $temp['created_date'] = $row->created_date;
            $temp['updated_date'] = $row->updated_date;
            $temp['status'] = $row->status;
            $id = $row->id;
            
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_test"> Edit</a>  	&nbsp;';
            $action .= '<a data-id="'.$id.'" class="btn btn-xs btn-danger btnDelete_test"> Delete</a></div>';
            
            
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
