<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class NewsletterController extends Controller {

    public function __construct() {
//        $this->middleware('admin');
    }

    public function index() {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Newsletter", URL::to('/admin/newsletter'));
        //This is for breadcrumb

        return view("admin.newsletter.newsletter_list");
    }

    public function deleterecord(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                DB::table('news_latter')
                        ->where('id', $id)
                        ->update(array('status' => -1));

                $data_result['status'] = 1;
                $data_result['msg'] = "Record deleted successfully.";
            }
        }
        echo json_encode($data_result);
        exit;
    }

    public function anyData() {

        $requestData = $_REQUEST;

        $data = array();

        //This is for order 
        $columns = array(
            0. => 'id',
            1 => 'email',
            2 => 'status',
            3 => 'created_at',
            4 => 'updated_at',
        );

        $select_query = DB::table('news_latter')->where('status', '!=', -1);
        $select_query->select('*', DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("email", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("created_at", "DESC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $news_latter_list = $select_query->get();
        foreach ($news_latter_list as $row) {
            $temp['id'] = $row->id;
            $temp['email'] = $row->email;
            $temp['status'] = $row->status;
            $temp['created_at'] = $row->created_at;
            $temp['updated_at'] = $row->updated_at;
            $id = $row->id;

            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-danger btnDelete_news_latter"> Delete</a></div>';
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
