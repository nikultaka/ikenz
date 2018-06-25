<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\SiteSetting as site;

class MediaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('Admin.media.category_list');
    }
    
    public function add(){
        return view('Admin.media.add_category');
    }
    
    public function get_category_data()
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
        
        $select_query = DB::table('media_category');
        $select_query->select('*',DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
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