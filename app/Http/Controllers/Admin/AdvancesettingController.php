<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class AdvancesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
//        $this->middleware('admin');
    }
    public function index()
    {   
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Advance Settings",URL::to('/admin/advancesettings'));
        //This is for breadcrumb
        
        return view('Admin.setting.advance_custom_filds');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data=array();
        $result=array();
        $result['status']=0;
        
        $post = $request->input();
        
        if(!empty($post)){
            if(isset($post['id'])){
                $id = $post['id'];
            }

            $data['label'] = isset($post['adc_label'])?$post['adc_label']:'';
            $data['fild_name'] = isset($post['adc_fild_name'])?$post['adc_fild_name']:'';
            $data['fild_value'] = isset($post['adc_fild_value'])?$post['adc_fild_value']:'';
            $data['status']=1;
            
            
            if(isset($post['id']) && $post['id'] != ''){
                
                $data['updated_at']=date("Y-m-d h:i:s");
                
                $returnresult= DB::table('advance_custom_details')
                   ->where('id',$id)     
                   ->update($data);
                
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
            }
            else{
                
                $data['created_at']=date("Y-m-d h:i:s");
                
                if(DB::table('advance_custom_details')->insert($data)){
                    $result['status']=1;
                    $result['msg']="Record add sucessfully..!";
                }   
            }
        }
        echo json_encode($result);
        exit;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        $post = $request->input();
        $data_result=array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

            $adv_set =DB::table('advance_custom_details')
                    ->where('id','=',$id)->first();
        
            $data_result=array();
            $data_result['status']=1;
            $data_result['content']=$adv_set;
            }
        }
        echo json_encode($data_result);
        exit;
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $post = $request->input();
        $data_result=array();
        $data_result['status'] = 0;
        
        if(!empty($post)){
            $id = isset($post['id'])?$post['id']:'';
            if($id != ""){

                DB::table('advance_custom_details')
                    ->where('id', $id)
                    ->update(array('status'=>-1));

                $data_result['status']=1;
                $data_result['msg']="Record deleted successfully.";
            }
        }
        echo json_encode($data_result);
        exit;
        
    }
        
        
    public function getdatatable()
    {
        
        $requestData = $_REQUEST;

        $data = array();

        $select_query = DB::table('advance_custom_details')->where('status','1');
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        //This is for search value
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("label","like",'%'.$requestData['search']['value'].'%')
                    ->orWhere("fild_name","like",'%'.$requestData['search']['value'].'%')
                    ->orWhere("fild_value","like",'%'.$requestData['search']['value'].'%');
        }

        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'label',
            2 => 'fild_name',
            3 => 'fild_value',
            4 => 'status',
            5 => 'created_at',
            6 => 'updated_at',
        );
        
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("created_at","DESC");
        }
        
        //This is for count
        $totalData = $select_query->count();
        
        //This is for count
        
        $result= $select_query->count();
        
        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $service_price_list = $select_query->get();
        
        foreach ($service_price_list as $row) {
            
            $temp['id'] = $row->id;
            $temp['label'] = $row->label;
            $temp['fild_name'] = $row->fild_name;
            $temp['fild_value'] = $row->fild_value;
            $temp['created_at'] = $row->created_at;
            $temp['updated_at'] = $row->updated_at;
            $temp['status'] = $row->status;

            $id = $row->id;
            
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
            $action .= '<a data-id="'.$id.'" class="btn btn-xs btn-danger btnDeletefilddetails"> Delete</a></div>';
            
            $temp['action'] = $action;
            $data[] = $temp;
            $id = "";
        }



        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($result),
            "recordsFiltered" => intval($result),
            "data" => $data
            
        );
        echo json_encode($json_data);
        exit(0);
            
    }
        
    
}
