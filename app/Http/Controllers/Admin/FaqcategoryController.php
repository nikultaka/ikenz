<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;

class FaqcategoryController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        return view("admin.faq_category.faqcategory_list");
        
    }
    
    public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        if($_POST){
            if($request->input('id_faq_cat')){
                $id_faq_cat = $request->input('id_faq_cat');
            }
            $data['category_name'] = $request->input('category_name');
            $data['status'] = $request->input('status');;
            
            
            if(isset($_POST['id_faq_cat']) && $_POST['id_faq_cat'] != ''){
                $data['updated_at']=date("Y-m-d h:i:s");
                $returnresult= DB::table('faq_category')
                   ->where('id',$id_faq_cat)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['created_at']=date("Y-m-d h:i:s");
                $data['updated_at']=date("Y-m-d h:i:s");
                if(DB::table('faq_category')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        
    }
    
    public function editfaq_category(){
        $id=$_POST['faq_cat_id'];
        $faq =DB::table('faq_category')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$faq;
        echo json_encode($data_result);exit;
    }
    
     public function deleterecord(){
        $id=$_POST['faq_cat_id'];
        if(isset($id) && $id !=''){
            DB::table('faq_category')
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
            1 => 'category_name',
            2 => 'status',
            3 => 'created_at',
            4 => 'updated_at',
        );
        
        $select_query = DB::table('faq_category');
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("category_name","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("category_name","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("category_name","like",'%'.$requestData['search']['value'].'%');
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

        $media_category_list = $select_query->get();
        foreach ($media_category_list as $row) {
            $temp['id'] = $row->id;
            $temp['category_name'] = $row->category_name;
            $temp['created_at'] = $row->created_at;
            $temp['updated_at'] = $row->updated_at;
            $temp['status'] = $row->status;
            $id = $row->id;
            
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_faqcat"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_faqcat"> Delete</a></div>';
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
