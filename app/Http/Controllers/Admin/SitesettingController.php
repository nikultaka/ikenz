<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\SiteSetting as site;
use Image;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class SitesettingController extends Controller
{
     public function __construct()
    {
       // $this->middleware('admin');
    }
    public function index(){
        
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Setting",URL::to('/admin/setting'));
        //This is for breadcrumb
        
        $data=array();
        $result=DB::table('site_setting')->get();
        foreach ($result as $key=>$value){
            $data[$value->option_name] =$value->option_value;
        }
        return view('Admin.setting.setting')->with($data);
    }
    public function save_details(Request $request){
       $site=new site();
       $data['status']=0;
       
      $current_date_time=date("Y-m-d h:i:sa");
       $site_title=$request->input('site_title');
       $email_id=$request->input('email_id');
       $smtp_email=$request->input('smtp_email');
       $smtp_host=$request->input('smtp_host');
       $smtp_password=$request->input('smtp_password');
       $smtp_port=$request->input('smtp_port');
       $option_name=array('site_title'=>$site_title,'user_email'=>$email_id,'smtp_email'=>$smtp_email,'smtp_host'=>$smtp_host,'smtp_password'=>$smtp_password,'smtp_port'=>$smtp_port);
       foreach ($option_name as $key=>$option){
          
       $data_site_title= $site->get_value_by_option_name($key);
       if(!empty($data_site_title)){
           $site->update_value_by_option_name($key,$option);
           $data['status']=1;
           $data['msg']="Data Add Successfully..!";
        }
       else {
            $data=array();
            $data['option_name']=$key;
            $data['option_value']=$option;
            $data['status']=1;
            $data['created_date']=$current_date_time;
            $data['updated_date']=$current_date_time;
            $site->insert_value_site_setting($data);
            $data['status']=1;
            $data['msg']="Data Add Successfully..!";
        }    
       }
       return json_encode($data);
       
       
    }
    public function uploadlogo(Request $request){
        $result=array();
        $result['status']=0;
        $site=new site();
        $filename  = basename($_FILES['setting_logo_upload']['name']);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if($file = $request->hasFile('setting_logo_upload')) {
                    
            $file = $request->file('setting_logo_upload') ;
            $input['setting_logo_upload'] = time().'.'.$file->getClientOriginalExtension();


            $destinationPath = public_path().'/thumbnail/';
            $uniquesavename=time().uniqid(rand());
            $destFile = $uniquesavename . '.'.$extension;
            $img = Image::make($file->getRealPath())->resize(250, 250);
            $img->save($destinationPath.'/'.$input['setting_logo_upload']);


            $destinationPath = public_path().'/upload/';
            $uniquesavename=time();
            $destFile = $uniquesavename . '.'.$extension;
            if($file->move($destinationPath,$destFile)){
                $data=array();
                $data_site_title= $site->get_value_by_option_name('site_logo');
                if(!empty($data_site_title)){
                    $site->update_value_by_option_name('site_logo',$destFile);
                    $data['status']=1;
                    $data['msg']="Data Add Successfully..!";
                 }
                 else{
                    $data['option_name']='site_logo';
                    $data['option_value']=$destFile;
                    $data['status']=1;
                    $data['created_date']=date('Y-m-d');
                    $data['updated_date']=date('Y-m-d');
                    $site->insert_value_site_setting($data);
                 }
            }
            $result['status']=1;
            $result['data']=$destFile;
        }
        echo json_encode($result);
    }
}