<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Cms;
use App\Models\SiteSetting as site;

class CmsController extends Controller
{
     public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('admin');
    }
    public function index(){
        return view('Admin.cms.add');
    }
    
    public function cms_list(){
        return view('Admin.cms.cms_list');
    }
    
     public function addrecord(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        if($_POST){
            if($request->input('id_cms')){
                $id_cms = $request->input('id_cms');
            }
            $data['title'] = $request->input('title');
            $data['slug_url'] = $request->input('slug');
            $data['description'] = $request->input('description');
            $data['meta_title'] = $request->input('meta_title');
            $data['meta_keyword'] = $request->input('meta_keyword');
            $data['meta_description'] = $request->input('meta_description');
            $data['status'] = $request->input('status');
            
            
            if(isset($_POST['id_cms']) && $_POST['id_cms'] != ''){
                $data['updated_at']=date("Y-m-d h:i:s");
                $returnresult= DB::table('cms')
                   ->where('id',$id_cms)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['created_at']=date("Y-m-d h:i:s");
                $data['updated_at']=date("Y-m-d h:i:s");
                if(DB::table('cms')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        exit;
        
    }
    
      public function editcms(){
        $id=$_POST['id'];
        $cms =DB::table('cms')->where('id','=',$id)->first();
        $data_result=array();
        $data_result['status']=1;
        $data_result['content']=$cms;
        echo json_encode($data_result);exit;
    }
    
    
    public function check_slug(Request $request) {
        
        $id = $request->input('id');
        $slug_url = $request->input('slug');
        $valid = TRUE;
        $slug =DB::table('cms')
                ->select('id')
                ->select('slug_url')
                ->where('id','!=',$id)
                ->where('slug_url','=',$slug_url)
                ->get();
        $slug_all = count($slug);
            
            if($slug_all > 0){
                $valid = FALSE;
            }
            else{
                $valid = TRUE;
            }            
            return json_encode(array('valid' => $valid));exit;
   
            
    }   
    
    
    
     public function deleterecord(){
        $id=$_POST['id'];
        if(isset($id) && $id !=''){
            DB::table('cms')
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
    
    
    
     public function anyData()
    {
//         return view('Admin.cms.cms_list');
                 
        $requestData = $_REQUEST;

        $data = array();
        
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'title',
            2 => 'slug_url',
            3 => 'description',
            4 => 'meta_title',
            5 => 'meta_keyword',
            6 => 'meta_description',
            7 => 'status',
            8 => 'created_at',
            9 => 'updated_at',
        );
        
        $select_query = DB::table('cms')
                        ->where('status','!=',-1);

        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("title","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("slug_url","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("meta_title","like",'%'.$requestData['search']['value'].'%')
                         ->oRwhere("meta_keyword","like",'%'.$requestData['search']['value'].'%');
            
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

        $cms_list = $select_query->get();
        foreach ($cms_list as $row) {
            
            $temp['id'] = $row->id;
            $temp['title'] = $row->title;
            $temp['slug_url'] = $row->slug_url;
            $temp['meta_title'] = $row->meta_title;
            $temp['meta_keyword'] = $row->meta_keyword;
            $temp['created_at'] = $row->created_at;
            $temp['status'] = $row->status;
            $id = $row->id;
           
            $action = '<div class="datatable_btn"><a href="cms/index/'.$id.'" data-id="'.$id.'" class="btn btn-xs btn-info btnEdit_cms"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="'.$id.'" type="button" class="btn btn-xs btn-danger btnDelete_cms"> Delete</a></div>';

            
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
    
    
    
    
    
    
    
    
//    public function save_details(Request $request){
//       $site=new site();
//       $data['status']=0;
//       
//      $current_date_time=date("Y-m-d h:i:sa");
//       $site_title=$request->input('site_title');
//       $email_id=$request->input('email_id');
//       $smtp_email=$request->input('smtp_email');
//       $smtp_host=$request->input('smtp_host');
//       $smtp_password=$request->input('smtp_password');
//       $smtp_port=$request->input('smtp_port');
//       $option_name=array('site_title'=>$site_title,'user_email'=>$email_id,'smtp_email'=>$smtp_email,'smtp_host'=>$smtp_host,'smtp_password'=>$smtp_password,'smtp_port'=>$smtp_port);
//       foreach ($option_name as $key=>$option){
//          
//       $data_site_title= $site->get_value_by_option_name($key);
//       if(!empty($data_site_title)){
//           $site->update_value_by_option_name($key,$option);
//           $data['status']=1;
//           $data['msg']="Data Add Successfully..!";
//        }
//       else {
//            $data=array();
//            $data['option_name']=$key;
//            $data['option_value']=$option;
//            $data['status']=1;
//            $data['created_date']=$current_date_time;
//            $data['updated_date']=$current_date_time;
//            $site->insert_value_site_setting($data);
//            $data['status']=1;
//            $data['msg']="Data Add Successfully..!";
//        }    
//       }
//       return json_encode($data);
//       
//       
//    }
//    public function uploadlogo(Request $request){
//        echo '<pre>';
//        print_r($_FILES);
//        die;
//    }
}