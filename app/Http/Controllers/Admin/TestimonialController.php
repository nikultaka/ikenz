<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Validator;
use Illuminate\Support\Facades\DB;
//use Yajra\Datatables\Datatables;
use yajra\Datatables\Facades\Datatables;
use Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $data_result=array();
        $test_list = Testimonial::where('status', '=', 1)->get();
        $data_result['test_list']=$test_list;
        return view("admin.testimonial.testimonial_list")->with($data_result);
        
    }
    
    public function anyData()
        {
          $testimonial=DB::table('testimonial')
                    ->select('*')
                    ->where('status',1)
                    ->get();
          $testimonial= collect($testimonial);
          
             return Datatables::of($testimonial)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                                ->addColumn('action', function ($testimonial) {
                                $button= '<a href="javascript:void(0);" data-id="'.$testimonial->id.'" class="btn btn-xs btn-info btnEdit_test"> Edit</a>&nbsp;';
//                                $button= '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$testimonial->id.'" class="btn btn-xs btn-info btnEdit_test"> Edit</a>  	&nbsp;';
                                $button .='<a onclick="delete_test('.$testimonial->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
                                return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
        }
    
    public function addrecord(Request $request){
        
        
            $filename  = basename($_FILES['user_photo']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            date_default_timezone_set("Asia/Kolkata");
            
            $validator = Validator::make($request->all(), [
                'cus_name' => 'required',
                'feedback' => 'required',
                'user_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required',
                
                    ]);
            if ($validator->passes()) {   
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
                $user_photo = $destFile;
                $status = $request->input('status');

                $data_insert = array();
                $data_insert['customer_name']=$cus_name;
                $data_insert['feedback']=$feedback;
                $data_insert['user_photo']=$user_photo;
                $data_insert['status']=$status;
                $data_insert['created_date']=date("Y-m-d h:i:s");
                $data_insert['updated_date']=date("Y-m-d h:i:s");
                

                Testimonial::insert($data_insert);
                return response()->json(['success'=>'Added new records.']);
                    }
            return response()->json(['error'=>$validator->errors()->all()]);  
        
    }
    
    public function edittestimonial(){
        $id=$_POST['test_id'];
        $charges =DB::table('testimonial')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$charges;
//        print_r($data_result);exit;
        return $data_result;   
    }
    
    
    
    
    
     public function deleterecord(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('testimonial')
                    ->where('id', $id)
                    ->update(array('status'=>-1));
        $data_result=array();
        $data_result['status']=1;
        $data_result['msg']="Record deleted success.";
        
        return $data_result;
        }
        else {
            return response()->json(['error'=>'record Not Found']);
        }
    }
    
    
}
