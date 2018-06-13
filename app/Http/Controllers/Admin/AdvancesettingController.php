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
        $this->middleware('auth');
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
    public function edit()
    {
        $result=array();
        $result['status']=0;
        
        if(isset($_POST['fildid']) && $_POST['fildid'] !='' ){
            $fild_id=$_POST['fildid'];
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
    public function destroy()
    {   
        $result=array();
        $result['status']=0;
        
        if(isset($_POST['fildid']) && $_POST['fildid'] !='' ){
            $fild_id=$_POST['fildid'];
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
        $sql = "SELECT * FROM advance_custom_details ";
        //This is for search value
        $sql .= " WHERE status = 1 ";
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $sql .= " AND (label LIKE '%" . $requestData['search']['value'] . "%' OR fild_name LIKE '%" . $requestData['search']['value'] . "%' OR fild_value LIKE '%" . $requestData['search']['value'] . "%') ";
        }

        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'label',
            2 => 'fild_name',
            3 => 'fild_value',
            4 => 'status',
            5 => 'gm_created',
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
        
        $result=DB::table('advance_custom_details')
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

        //echo $sql; die;
        
        $service_price_list = DB::select($sql);
        $arr_data = Array();
        $arr_data = $result;


        foreach ($service_price_list as $row) {
            $temp['id'] = $row->id;
            $temp['label'] = $row->label;
            $temp['fild_name'] = $row->fild_name;
            $temp['fild_value'] = $row->fild_value;
            $temp['gm_created'] = $row->gm_created;
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

            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
            $action .= '<a data-id="'.$id.'" class="btn btn-xs btn-danger btnDeletefilddetails"> Delete</a></div>';
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
