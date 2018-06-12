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
            $data['label']=$request->input('adc_label');
            $data['fild_name']=$request->input('adc_fild_name');
            $data['fild_value']=$request->input('adc_fild_value');
            $data['status']=1;
            $data['gm_created']=date("Y-m-d h:i:s");
            $data['gm_updated']=date("Y-m-d h:i:s");
            if(DB::table('advance_custom_details')->insert($data)){
                $result['status']=1;
                $result['msg']="Record add sucessfully..!";
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
    public function getdatatable()
        {
        $members=DB::table('advance_custom_details')
                    ->select('advance_custom_details.*')
                    ->where('status',1)
                    ->get();
           $members= collect($members); 
           
             return Datatables::of($members)->editColumn('status', function($data) {
                                return ($data->status == 1) ? trans('Active'): trans('Inactive');
                                })
                                ->addColumn('action', function ($members) {
                                $button= '<div class="datatable_btn"><a href="javascript:void(0);" data-id="'.$members->id.'" class="btn btn-xs btn-info btnEditMember"> Edit</a>  	&nbsp;';
                                $button .='<a onclick="delete_member('.$members->id.')" class="btn btn-xs btn-danger"> Delete</a></div>';
                                return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
          
        }
    
}
