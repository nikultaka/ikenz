<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact_us;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class Contact_usController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('admin');
    }
    
    public function index()
    {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Contact us",URL::to('/admin/contact_us'));
        //This is for breadcrumb
        
        return view("admin.contact_us.contact_us_list");
        
    }
    
    public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        
        $post = $request->input();
        
        if(!empty($post)){
            if(isset($post['id'])){
                $id = $post['id'];
            }
            
            $data['name'] = isset($post['name'])?$post['name']:'';
            $data['email'] = isset($post['email'])?$post['email']:'';
            $data['phone_no'] = isset($post['phone_no'])?$post['phone_no']:'';
            $data['description'] = isset($post['description'])?$post['description']:'';
            $data['status'] = isset($post['status'])?$post['status']:'';

            if(isset($post['id']) && $post['id'] != ''){
                
                $data['updated_at']=date("Y-m-d h:i:s");

                $returnresult= DB::table('contact_us')
                   ->where('id',$id)     
                   ->update($data);
                
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
            }
            else{
                $data['created_at']=date("Y-m-d h:i:s");
                if(DB::table('contact_us')->insert($data)){
                    $result['status']=1;
                    $result['msg']="Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
        
    }
      
    public function editcontact_us(Request $request){

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

            $contact_us = DB::table('contact_us')
                    ->where('id','=',$id)->first();
        
            $data_result['status'] = 1;
            $data_result['content'] = $contact_us;
            }
        }
        echo json_encode($data_result);
        exit;
        
        
        
    }
    
    public function email_reply(Request $request){
        
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){
                
                $email_reply = DB::table('contact_us')
                        ->select('email')
                        ->where('id','=',$id)->first();
                
                $data_result['status'] = 1;
                $data_result['content'] = $email_reply;
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

                DB::table('contact_us')
                    ->where('id', $id)
                    ->update(array('status'=>-1));

                $data_result['status']=1;
                $data_result['msg']="Record deleted successfully.";
            }
        }
       
        
        
        
        
    }
    
    
    public function anyData()
    {
        
        $requestData = $_REQUEST;

        $data = array();
        
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone_no',
            4 => 'description',
        );
        
        $select_query = DB::table('contact_us')
                    ->where('status', '!=',-1);
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("name","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("email","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("phone_no","like",'%'.$requestData['search']['value'].'%');
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

        $contact_us_list = $select_query->get();
        foreach ($contact_us_list as $row) {
            $temp['id'] = $row->id;
            $temp['name'] = $row->name;
            $temp['email'] = $row->email;
            $temp['phone_no'] = $row->phone_no;
            $temp['description'] = $row->description;
            $temp['reply'] = '<i class="fa fa-mail-reply em_reply" data-id="'.$row->id.'" onclick="email_reply('.$row->id.')"></i>';
            $temp['status'] = $row->status;
            $id = $row->id;
 
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_contact_us"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_contact_us"> Delete</a></div>';

            
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
