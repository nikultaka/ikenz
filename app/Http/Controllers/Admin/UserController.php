<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Faqcategory;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
    }
    
    public function index()
    {
        $data_result=array();
        $user_role = DB::table('user_role')->where('status', '=', 1)->get();
        $data_result['user_role']=$user_role;
        return view("admin.user.user_list")->with($data_result);
        
    }
    
    public function addrecord(Request $request){   
        
        $data=array();
        $result=array();
        $result['status']=0;
        
        $post = $request->input();
        
        if(!empty($post)){
            if(isset($post['id'])){
                $id = $post['id'];
            }
            
            $data['role_id'] = isset($post['role_name'])?$post['role_name']:'';
            $data['name'] = isset($post['u_name'])?$post['u_name']:'';
            $data['email'] = isset($post['email'])?$post['email']:'';
            $data['password'] = isset($post['password'])?$post['password']:'';
            $data['status'] = isset($post['status'])?$post['status']:'';
            
            
            if(isset($post['id']) && $post['id'] != ''){
                
                $data['updated_at']=date("Y-m-d h:i:s");
                
                $returnresult= DB::table('users')
                   ->where('id',$id)     
                   ->update($data);
                
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
            }
            else{
                
                $data['created_at']=date("Y-m-d h:i:s");
                if(DB::table('users')->insert($data)){
                    $result['status']=1;
                    $result['msg']="Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
        
    }
      
    public function edituser(Request $request){
        
        $post = $request->input();
        $data_result=array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

            $user =DB::table('users')
                    ->where('id','=',$id)->first();
        
            $data_result['status']=1;
            $data_result['content']=$user;
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

                DB::table('users')
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
            0. => 'u.id',
            1 => 'u.role_id',
            2 => 'u.name',
            3 => 'u.email',
            4 => 'u.password',
            5 => 'u.status',
            6 => 'u.created_at',
            7 => 'u.updated_at',
            8 => 'ur.role_name',
        );
        
        $select_query = DB::table('users as u')
                        ->join('user_role as ur','u.role_id','=','ur.id')
                        ->where('u.status','!=',-1);
        
        $select_query->select('u.*','ur.role_name',DB::raw("IF(u.status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("u.name","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("ur.role_name","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("u.name","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("u.email","like",'%'.$requestData['search']['value'].'%');
        }
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("u.created_at","DESC");
        }
        
        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $user_list = $select_query->get();
        foreach ($user_list as $row) {
            
            $temp['role_name'] = $row->role_name;
            $temp['name'] = $row->name;
            $temp['email'] = $row->email;
            $temp['password'] = $row->password;
            $temp['status'] = $row->status;
            $id = $row->id;
           
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_user"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_user"> Delete</a></div>';

            
            $temp['action'] = $action;
            $data[] = $temp;
            $id = "";
        }
        
//        print_r($data);exit;


        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        echo json_encode($json_data);
        exit(0);
            
    }
    
    public function check_email(Request $request) {
        
        $post = $request->input();        
        $id = $post['id'];
        $email_id = $post['email'];
        $valid = TRUE;
        $email =DB::table('users')
                ->select('id')
                ->select('email')
                ->where('id','!=',$id)
                ->where('email','=',$email_id)
                ->get();
        
        $email_all = count($email);
            
            if($email_all > 0){
                $valid = FALSE;
            }
            else{
                $valid = TRUE;
            }            
            return json_encode(array('valid' => $valid));exit;
   
            
    }   
    
    
    
}
