<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Cms;
use App\Models\SiteSetting as site;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class CmsController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//        $this->middleware('admin');
    }

    public function index() {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("CMS", URL::to('/admin/cms/list'));
        CommonHelper::add_breadcrumb("Add CMS", URL::to('/admin/cms'));
        //This is for breadcrumb

        return view('Admin.cms.add');
    }

    public function cms_list() {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("CMS", URL::to('/admin/cms/list'));

        return view('Admin.cms.cms_list');
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

            $data['title'] = isset($post['title']) ? $post['title'] : '';
            $data['slug_url'] = isset($post['slug']) ? $post['slug'] : '';
            $data['description'] = isset($post['description']) ? $post['description'] : '';
            $data['meta_title'] = isset($post['meta_title']) ? $post['meta_title'] : '';
            $data['meta_keyword'] = isset($post['meta_keyword']) ? $post['meta_keyword'] : '';
            $data['meta_description'] = isset($post['meta_description']) ? $post['meta_description'] : '';
            $data['status'] = isset($post['status']) ? $post['status'] : '';

            if (isset($post['id']) && $post['id'] != '') {

                $data['updated_at'] = date("Y-m-d h:i:s");

                $returnresult = DB::table('cms')
                        ->where('id', $id)
                        ->update($data);

                if ($returnresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Record updated successfully.!';
                }
            } else {
                $data['created_at'] = date("Y-m-d h:i:s");
                if (DB::table('cms')->insert($data)) {
                    $result['status'] = 1;
                    $result['msg'] = "Record add sucessfully..!";
                }
            }
        }
        echo json_encode($result);
        exit;
    }

    public function editcms(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $user = DB::table('cms')
                                ->where('id', '=', $id)->first();

                $data_result['status'] = 1;
                $data_result['content'] = $user;
            }
        }
        echo json_encode($data_result);
        exit;
    }

    public function check_slug(Request $request) {

        $post = $request->input();

        $id = $post['id'];
        $slug_url = $post['slug'];

        $slug = DB::table('cms')
                ->select('*')
                ->where('id', '!=', $id)
                ->where('status','!=',-1)
                ->where('slug_url', '=', $slug_url)
                ->get();

        $valid = TRUE;
        $slug_all = count($slug);

        if ($slug_all > 0) {
            $valid = FALSE;
        } else {
            $valid = TRUE;
        }
        return json_encode(array('valid' => $valid));
        exit;
    }

    public function deleterecord(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                DB::table('cms')
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
            1 => 'title',
            2 => 'slug_url',
            3 => 'description',
            4 => 'meta_title',
            5 => 'meta_keyword',
            6 => 'meta_description',
            7 => 'status',
            8 => 'created_at',
            9 => 'updated_at',
        );

        $select_query = DB::table('cms')
                ->where('status', '!=', -1);

        $select_query->select('*', DB::raw("IF(status = 1,'Active','Inactive') as status"));
        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("title", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("slug_url", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("meta_title", "like", '%' . $requestData['search']['value'] . '%')
                    ->oRwhere("meta_keyword", "like", '%' . $requestData['search']['value'] . '%');
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

        $cms_list = $select_query->get();
        foreach ($cms_list as $row) {

//            $temp['id'] = $row->id;
            $temp['title'] = $row->title;
            $temp['slug_url'] = $row->slug_url;
            $temp['meta_title'] = $row->meta_title;
            $temp['meta_keyword'] = $row->meta_keyword;
            $temp['created_at'] = $row->created_at;
            $temp['status'] = $row->status;
            $id = $row->id;

            $action = '<div class="datatable_btn"><a href="index/' . $id . '" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_cms"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" type="button" class="btn btn-xs btn-danger btnDelete_cms"> Delete</a></div>';


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
