<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;

class User_roleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        return view("admin.user.user_role_list");
        
    }
    
    public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        if($_POST){
            if($request->input('id_user_cat')){
                $id_user_cat = $request->input('id_user_cat');
            }
            $data['category'] = $request->input('user_category');
            $data['status'] = $request->input('status');;
            
            
            if(isset($_POST['id_user_cat']) && $_POST['id_user_cat'] != ''){
                $data['gm_updated']=date("Y-m-d h:i:s");
                $returnresult= DB::table('user_role')
                   ->where('id',$id_user_cat)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['gm_created']=date("Y-m-d h:i:s");
                $data['gm_updated']=date("Y-m-d h:i:s");
                if(DB::table('user_role')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        
    }
      
    public function edit_user_role(){
        $id=$_POST['user_cat_id'];
        $user_category =DB::table('user_role')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$user_category;
        echo json_encode($data_result);exit;
    }
    
     public function deleterecord(){
        $id=$_POST['user_cat_id'];
        if(isset($id) && $id !=''){
            DB::table('user_role')
                    ->where('id', $id)
                    ->update(array('status'=>-1));
        $data_result=array();
        $data_result['status']=1;
        $data_result['msg']="Record deleted success.";
        
        echo json_encode($data_result);exit;
        }
        else {
            return response()->json(['error'=>'record Not Found']);
        }   
    }
        
     public function anyData()
    {
        
        $requestData = $_REQUEST;

        $data = array();
        
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'category',
            2 => 'status',
            3 => 'gm_created',
            4 => 'gm_updated',
        );
        
        $select_query = DB::table('user_role')
                        ->where('status','!=',-1);

        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("category","like",'%'.$requestData['search']['value'].'%');   
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

        $faq_list = $select_query->get();
        foreach ($faq_list as $row) {
            
            $temp['id'] = $row->id;
            $temp['category'] = $row->category;
            $temp['status'] = $row->status;
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
