<?php

namespace App\Http\Controllers;

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
            if(isset($_POST['fild_id'])){
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
        $fild_details=DB::table('advance_custom_details')
                    ->select('advance_custom_details.*')
                    ->where('status',1)
                    ->get();
           $fild_details= collect($fild_details); 
           
             return Datatables::of($fild_details)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                                ->addColumn('action', function ($fild_details) {
                                $button= '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$fild_details->id.'" class="btn btn-xs btn-info btnEditfilddetails"> Edit</a>  	&nbsp;';
                                $button .='<a data-id="'.$fild_details->id.'" class="btn btn-xs btn-danger btnDeletefilddetails"> Delete</a></div>';
                                return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
          
        }
    
}
