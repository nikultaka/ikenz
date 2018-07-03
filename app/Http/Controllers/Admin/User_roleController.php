<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class User_roleController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
    }
    
    public function index()
    {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("User Role",URL::to('/admin/user_role'));
        //This is for breadcrumb
        
        return view("admin.user.user_role_list");
        
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
            
            $data['role_name'] = isset($post['role_name'])?$post['role_name']:'';
            $data['status'] = isset($post['status'])?$post['status']:'';
            
            if(isset($post['id']) && $post['id'] != ''){
                
                $data['updated_at']=date("Y-m-d h:i:s");
                
                $returnresult= DB::table('user_role')
                   ->where('id',$id)     
                   ->update($data);
                
                    if($returnresult){
                        $result['status']=1;
                        $result['msg']='Record updated successfully.!';
                    }
            }
            else{
                
                $data['created_at']=date("Y-m-d h:i:s");
                if(DB::table('user_role')->insert($data)){
                    $result['status']=1;
                    $result['msg']="Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
    }
      
    public function edit_user_role(Request $request){
      
        $post = $request->input();
        $data_result=array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

            $user_role =DB::table('user_role')
                    ->where('id','=',$id)->first();
        
            $data_result['status']=1;
            $data_result['content']=$user_role;
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

                DB::table('user_role')
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
            1 => 'role_name',
            2 => 'status',
            3 => 'created_at',
            4 => 'updated_at',
        );
        
        $select_query = DB::table('user_role')
                        ->where('status','!=',-1);

        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("role_name","like",'%'.$requestData['search']['value'].'%');   
        }
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("created_at","DESC");
        }
        
        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $user_role_list = $select_query->get();
        foreach ($user_role_list as $row) {
            
            $temp['id'] = $row->id;
            $temp['role_name'] = $row->role_name;
            $temp['status'] = $row->status;
            $temp['created_at'] = $row->created_at;
            $id = $row->id;
           
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_user_cat"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_user_cat"> Delete</a></div>';

            
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
