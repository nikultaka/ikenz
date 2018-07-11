<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Models\Faq;
//use App\Models\Faqcategory;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//        $this->middleware('admin');
    }

    public function index() {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("product", URL::to('/admin/product'));
        //This is for breadcrumb

        $data_result = array();
        $user = DB::table('users')->where('status', '=', 1)->get();
        $data_result['user'] = $user;
        return view("admin.product.product_list")->with($data_result);
    }

    public function addrecord(Request $request) {
        $data = array();
        $result = array();
        $result['status'] = 0;

        $post = $request->input();

        if (!empty($post)) {
            if (isset($post['id'])) {
                $id = $post['id'];
            }

            $data['user_id'] = isset($post['user_id']) ? $post['user_id'] : '';
            $data['title'] = isset($post['title']) ? $post['title'] : '';
            $data['short_description'] = isset($post['short_description']) ? $post['short_description'] : '';
            $data['price'] = isset($post['price']) ? $post['price'] : '';
            $data['description'] = isset($post['description']) ? $post['description'] : '';
            $data['status'] = isset($post['status']) ? $post['status'] : '';

            if (isset($post['id']) && $post['id'] != '') {

                $data['updated_at'] = date("Y-m-d h:i:s");

                $returnresult = DB::table('product')
                        ->where('id', $id)
                        ->update($data);

                if ($returnresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Record updated successfully.!';
                }
            } else {

                $data['created_at'] = date("Y-m-d h:i:s");

                if (DB::table('product')->insert($data)) {
                    $result['status'] = 1;
                    $result['msg'] = "Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
    }

    public function editproduct(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $product = DB::table('product')
                                ->where('id', '=', $id)->first();

                $data_result = array();
                $data_result['status'] = 1;
                $data_result['content'] = $product;
            }
        }
        
        echo json_encode($data_result);
        exit;
    }

    public function deleterecord(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                DB::table('product')
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
            0. => 'p.id',
            1 => 'u.name',
            2 => 'p.title',
            3 => 'p.short_description',
            4 => 'p.price',
            5 => 'p.status',
            6 => 'p.created_at',
            7 => 'p.updated_at',
        );

        $select_query = DB::table('product as p')
                ->join('users as u', 'p.user_id', '=', 'u.id')
                ->where('p.status', '!=', -1);

        $select_query->select('p.*','u.name', DB::raw("IF(p.status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("u.name", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("p.title", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("p.price", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("p.short_description", "like", '%' . $requestData['search']['value'] . '%');
        }

        if (isset($requestData['order'][0]['column']) && $requestData['order'][0]['column'] != '' && isset($requestData['order'][0]['dir']) && $requestData['order'][0]['dir'] != '') {
            $order_by = $columns[$requestData['order'][0]['column']];
            $select_query->orderBy($order_by, $requestData['order'][0]['dir']);
        } else {
            $select_query->orderBy("p.created_at", "DESC");
        }

        //This is for count
        $totalData = $select_query->count();

        //This is for pagination
        if (isset($requestData['start']) && $requestData['start'] != '' && isset($requestData['length']) && $requestData['length'] != '') {
            $select_query->offset($requestData['start']);
            $select_query->limit($requestData['length']);
        }

        $product_list = $select_query->get();
        foreach ($product_list as $row) {

            $temp['id'] = $row->id;
            $temp['name'] = $row->name;
            $temp['title'] = $row->title;
            $temp['short_description'] = $row->short_description;
            $temp['price'] = $row->price;
            $temp['status'] = $row->status;
            $id = $row->id;

            $action = '<div class="datatable_btn"><a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_product"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" type="button" class="btn btn-xs btn-danger btnDelete_product"> Delete</a></div>';

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
