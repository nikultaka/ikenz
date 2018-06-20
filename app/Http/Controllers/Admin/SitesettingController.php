<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\SiteSetting as site;
use Image;
class SitesettingController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data=array();
        $result=DB::table('site_setting_option')->get();
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
        $filename  = basename($_FILES['setting_logo_upload']['name']);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if($file = $request->hasFile('setting_logo_upload')) {
                    
            $file = $request->file('setting_logo_upload') ;
            $input['setting_logo_upload'] = time().'.'.$file->getClientOriginalExtension();


            $destinationPath = public_path().'/thumbnail';
            $img = Image::make($file->getRealPath());
            $img->fit(100,100, function ($constraint) {
                $constraint->aspectRatio();        
            })->save($destinationPath.'/'.$input['setting_logo_upload']);


            $destinationPath = public_path().'/upload/';
            $uniquesavename=time().uniqid(rand());
            $destFile = $uniquesavename . '.'.$extension;
            $file->move($destinationPath,$destFile);
            $result['status']=1;
            $result['data']=$destFile;
        }
        echo json_encode($result);
    }
}