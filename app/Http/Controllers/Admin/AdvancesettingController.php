<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;
use App\Http\Requests;

class AdvancesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
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
        if($_POST){
            if($request->input('fild_id')){
                $fild_id=$request->input('fild_id');
            }
            $data['label']=$request->input('adc_label');
            $data['fild_name']=$request->input('adc_fild_name');
            $data['fild_value']=$request->input('adc_fild_value');
            $data['status']=1;
            
            
            if(isset($_POST['fild_id']) && $_POST['fild_id'] != ''){
                $data['gm_updated']=date("Y-m-d h:i:s");
                $returnresult= DB::table('advance_custom_details')
                   ->where('id',$fild_id)     
                   ->update($data);
                if($returnresult){
                    $result['status']=1;
                    $result['msg']='Record updated successfully.!';
                }
           
            }
            else{
                $data['gm_created']=date("Y-m-d h:i:s");
                $data['gm_updated']=date("Y-m-d h:i:s");
                if(DB::table('advance_custom_details')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
            }
            }
        }
        echo json_encode($result);
        
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
        $result=array();
        $result['status']=0;
        
        if(isset($_POST['fildid']) && $_POST['fildid'] !='' ){
            $fild_id=$request->input('fildid');
           $returnresult= DB::table('advance_custom_details')
                   ->where('id',$fild_id)     
                   ->first();
                        
           if($returnresult){
               $result['status']=1;
               $result['msg']=$returnresult;
           } 
        }
        echo json_encode($result);
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
        $result=array();
        $result['status']=0;
        
        if(isset($_POST['fildid']) && $_POST['fildid'] !='' ){
            $fild_id=$request->input('fildid');
           $returnresult= DB::table('advance_custom_details')
                   ->where('id',$fild_id)     
                   ->update(array('status'=>-1));
                        
           if($returnresult){
               $result['status']=1;
               $result['msg']='Record deleted successfully.!';
           } 
        }
        echo json_encode($result);
    }
        
        
         public function getdatatable()
    {
        
        $requestData = $_REQUEST;

        $data = array();
<<<<<<< HEAD
        
=======
        $select_query = DB::table('advance_custom_details');
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        //This is for search value
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("label","like",'%'.$requestData['search']['value'].'%')
                    ->orWhere("fild_name","like",'%'.$requestData['search']['value'].'%')
                    ->orWhere("fild_value","like",'%'.$requestData['search']['value'].'%');
        }

>>>>>>> 359ffa2aa68b33a8c26b689d68daf96eb6c20180
        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'label',
            2 => 'fild_name',
            3 => 'fild_value',
            4 => 'status',
            5 => 'gm_created',
        );
<<<<<<< HEAD
        
        $select_query = DB::table('advance_custom_details');
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("label","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("fild_name","like",'%'.$requestData['search']['value'].'%');
            $select_query->where("fild_value","like",'%'.$requestData['search']['value'].'%');
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
=======
        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
             $select_query->orderBy($order_by,$requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("id","DESC");
        }

        
        //This is for count
        
        $result= $select_query->count();
        $totalData = 0;
        $totalFiltered = 0;
        if ($result > 0) {
            $totalData = $result;
            $totalFiltered = $result;
        }

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            //$sql .= " LIMIT " . $requestData['start'] . "," . $requestData['length'];
            
>>>>>>> 359ffa2aa68b33a8c26b689d68daf96eb6c20180
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

<<<<<<< HEAD
        $service_price_list = $select_query->get();
=======
        
        $service_price_list = $select_query->get();
        $arr_data = Array();
        $arr_data = $result;


>>>>>>> 359ffa2aa68b33a8c26b689d68daf96eb6c20180
        foreach ($service_price_list as $row) {
            
            $temp['id'] = $row->id;
            $temp['label'] = $row->label;
            $temp['fild_name'] = $row->fild_name;
            $temp['fild_value'] = $row->fild_value;
            $temp['gm_created'] = $row->gm_created;
            $temp['status'] = $row->status;
<<<<<<< HEAD
            
=======

>>>>>>> 359ffa2aa68b33a8c26b689d68daf96eb6c20180
            $id = $row->id;
            
            
            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
            $action .= '<a data-id="'.$id.'" class="btn btn-xs btn-danger btnDeletefilddetails"> Delete</a></div>';
            
            $temp['action'] = $action;
            $data[] = $temp;
            $id = "";
        }



        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
<<<<<<< HEAD
            "recordsFiltered" => intval($totalData),
            "data" => $data
=======
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
            
>>>>>>> 359ffa2aa68b33a8c26b689d68daf96eb6c20180
        );
        echo json_encode($json_data);
        exit(0);
            
    }
        
    
}
