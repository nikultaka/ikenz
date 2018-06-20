<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Faqcategory;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;

class FaqController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $data_result=array();
        $cate_id = DB::table('faq_category')->where('status', '=', 1)->get();
        $data_result['cate_id']=$cate_id;
        return view("admin.faq.faq_list")->with($data_result);
        
    }
    
    public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        if($_POST){
            if($request->input('id_faq')){
                $id_faq = $request->input('id_faq');
            }
            $data['category_id'] = $request->input('category_id');
            $data['question'] = $request->input('question');
            $data['answer'] = $request->input('answer');
            $data['status'] = $request->input('status');
            
            
            if(isset($_POST['id_faq']) && $_POST['id_faq'] != ''){
                $data['updated_at']=date("Y-m-d h:i:s");
                $returnresult= DB::table('faq')
                   ->where('id',$id_faq)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['created_at']=date("Y-m-d h:i:s");
                $data['updated_at']=date("Y-m-d h:i:s");
                if(DB::table('faq')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        
    }
      
    public function editfaq(){
        $id=$_POST['faq_id'];
        $faq =DB::table('faq')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$faq;
        echo json_encode($data_result);exit;
    }
    
     public function deleterecord(){
        $id=$_POST['faq_id'];
        if(isset($id) && $id !=''){
            DB::table('faq')
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
            0. => 'f.id',
            1 => 'fc.category_name',
            2 => 'f.question',
            3 => 'f.answer',
            4 => 'f.status',
            5 => 'f.created_at',
            5 => 'f.updated_at',
        );
        
        $select_query = DB::table('faq as f')
                        ->join('faq_category as fc','f.category_id','=','fc.id')
                        ->where('f.status',1);

        $select_query->select('f.id','f.question','f.answer' ,'f.status' , 'fc.category_name',DB::raw("IF(f.status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("fc.category_name","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("f.question","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("f.answer","like",'%'.$requestData['search']['value'].'%');
            
        }
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("f.id","DESC");
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
            $temp['category_name'] = $row->category_name;
            $temp['question'] = $row->question;
            $temp['answer'] = $row->answer;
            $temp['status'] = $row->status;
            $id = $row->id;
           
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_faq"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_faq"> Delete</a></div>';

            
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
