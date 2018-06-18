<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact_us;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;

class Contact_usController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        return view("admin.contact_us.contact_us_list");
        
    }
    
    public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        if($_POST){
            if($request->input('id_c_us')){
                $id_c_us = $request->input('id_c_us');
            }
            $data['name'] = $request->input('name');
            $data['email'] = $request->input('email');
            $data['phone_no'] = $request->input('phone_no');
            $data['description'] = $request->input('description');;
            $data['status'] = 1;
            
            
            if(isset($_POST['id_c_us']) && $_POST['id_c_us'] != ''){
                $data['gm_updated']=date("Y-m-d h:i:s");
                $returnresult= DB::table('contact_us')
                   ->where('id',$id_c_us)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['gm_created']=date("Y-m-d h:i:s");
                $data['gm_updated']=date("Y-m-d h:i:s");
                if(DB::table('contact_us')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        exit;
        
    }
      
    public function editcontact_us(){
        $id=$_POST['c_us_id'];
        $contact_us =DB::table('contact_us')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$contact_us;
        echo json_encode($data_result);exit;
    }
    
    public function email_reply(){
        $id=$_POST['id'];
        $contact_us =DB::table('contact_us')->select('email')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$contact_us;
        echo json_encode($data_result);exit;
    }
    
    
     public function deleterecord(){
        $id=$_POST['c_us_id'];
        if(isset($id) && $id !=''){
            DB::table('contact_us')
                    ->where('id', $id)
                    ->update(array('status'=>-1));
        $data_result=array();
        $data_result['status']=1;
        $data_result['msg']="Record deleted successfully.";
        
        echo json_encode($data_result);exit;
        }
        else {
            return response()->json(['error'=>'record Not Found']);
        }   
    }
    
//    
    public function anyData()
    {
        
        $requestData = $_REQUEST;

        $data = array();
        $sql = "select * from contact_us";
        
        //This is for search value
        $sql .= " WHERE status = 1 ";
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $sql .= " AND (name LIKE '%" . $requestData['search']['value'] . "%' OR email LIKE '%" . $requestData['search']['value'] . "%' "
                    . "OR phone_no LIKE '%" . $requestData['search']['value'] . "%' OR description LIKE '%" . $requestData['search']['value'] . "%') ";
        }
        
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone_no',
            4 => 'description',
        );
        
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $sql .= " ORDER BY " . $order_by;
        } else {
            $sql .= " ORDER BY id DESC";
        }

        if (isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $sql .= " " . $requestData['order'][0]['dir'];
        } else {
            $sql .= " DESC ";
        }
        
        //This is for count
        
        $result=DB::table('contact_us')
                    ->where('status',1)
                    ->count();
        $totalData = 0;
        $totalFiltered = 0;
        if ($result > 0) {
            $totalData = $result;
            $totalFiltered = $result;
        }

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $sql .= " LIMIT " . $requestData['start'] . "," . $requestData['length'];
        }

        $service_price_list = DB::select($sql);
        $arr_data = Array();
        $arr_data = $result;
        
        
        foreach ($service_price_list as $row) {
            $temp['id'] = $row->id;
            $temp['name'] = $row->name;
            $temp['email'] = $row->email;
            $temp['phone_no'] = $row->phone_no;
            $temp['description'] = $row->description;
            $temp['reply'] = '<i class="fa fa-mail-reply em_reply" data-id="'.$row->id.'" onclick="email_reply('.$row->id.')"></i>';
            $status = $row->status;
            if ($status == "0") {

                $statusstring = "Deactive";
            } elseif ($status == "1") {
                $statusstring = "Active";
            } else {
                $statusstring = "";
            }
            $temp['status'] = $statusstring;

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
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
            "sql" => $sql
        );
        echo json_encode($json_data);
        exit(0);
            
        }
    
}
