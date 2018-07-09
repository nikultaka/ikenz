<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Bullet;
use Validator;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Facades\Datatables;
use Image;
use App\Helper\CommonHelper;
use Illuminate\Support\Facades\URL;

class BulletController extends Controller {

    public function __construct() {
//        $this->middleware('admin');
    }

    public function index() {
        //This is for breadcrumb
        CommonHelper::add_breadcrumb("Bullet", URL::to('/admin/bullet'));
        //This is for breadcrumb

        return view("admin.bullet.bullet_list");
    }

    public function addrecord(Request $request) {

        $data_insert = array();
        $result = array();
        $result['status'] = 0;

        $post = $request->input();

        if (!empty($post)) {
            if (isset($post['id'])) {
                $id_test = $post['id'];
            }
            $filename = basename($_FILES['image_upload']['name']);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $bulletObj = new Bullet($request->input());
            $uniquesavename = time() . uniqid(rand());


            if ($file = $request->hasFile('image_upload')) {

                $file = $request->file('image_upload');
                $input['image_upload'] = time() . '.' . $file->getClientOriginalExtension();


                $destinationPath = public_path() . '/upload/bullet/thumbnail';
                $img = Image::make($file->getRealPath());
                $destFile = $uniquesavename . '.' . $extension;
                $input['image_upload'] = $destFile;
                $img = Image::make($file->getRealPath())->resize(100, 100);
                $img->save($destinationPath . '/' . $input['image_upload']);

                $destinationPath = public_path() . '/upload/bullet/';
                $file->move($destinationPath, $destFile);
                $bulletObj->image_upload = $destFile;
            } else {
                $bulletObj->image_upload = isset($post['hdn_file']) ? $post['hdn_file'] : '';
            }
            $image_upload = $bulletObj->image_upload;

            $data_insert = array();
            $data_insert['title'] = isset($post['title']) ? $post['title'] : '';
            $data_insert['description'] = isset($post['description']) ? $post['description'] : '';
            $data_insert['image_upload'] = $image_upload;
            $data_insert['status'] = isset($post['status']) ? $post['status'] : '';


            if (isset($post['id']) && $post['id'] != '') {

                $data_insert['updated_at'] = date("Y-m-d h:i:s");

                $returnresult = DB::table('bullet')
                        ->where('id', $id_test)
                        ->update($data_insert);

                if ($returnresult) {
                    $result['status'] = 1;
                    $result['msg'] = 'Record updated successfully.!';
                }
            } else {

                $data_insert['created_at'] = date("Y-m-d h:i:s");
                if (DB::table('bullet')->insert($data_insert)) {
                    $result['status'] = 1;
                    $result['msg'] = "Record add sucessfully..!";
                }
            }
            echo json_encode($result);
            exit;
        }
    }

    public function editbullet(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

                $bullet = DB::table('bullet')
                        ->where('id', '=', $id)->first();

                $data_result['status'] = 1;
                $data_result['content'] = $bullet;
            }
        }
        echo json_encode($data_result);
        exit;
    }
    
    public function is_publish(Request $request) {
        
        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            $publish = isset($post['publish']) ? $post['publish'] : '';
            if ($id != "") {
                
                $bullet = DB::table('bullet')
                            ->where('status', '!=', -1)
                            ->where('is_publish', '=', 1)
                            ->get();
                $total_publish = count($bullet);

                if($total_publish == 0 && $publish == 0){
                    
                        $bullet = DB::table('bullet')
                                ->where('id', $id)
                                ->update(array('is_publish' => 1));

                        $data_result['status'] = 1;
                        $data_result['msg'] = "Record published successfully.";
                }
                
                else if($total_publish == 1 && $publish == 1){
                    
                        $bullet = DB::table('bullet')
                                    ->where('id', $id)
                                    ->update(array('is_publish' => 0));

                        $data_result['status'] = 1;
                        $data_result['msg'] = "Record unpublished successfully.";
                    
                }
                else {
                    $data_result['status'] = 2;
                    $data_result['msg'] = "Please unpublish another post first.";
                }
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

                DB::table('bullet')
                        ->where('id', $id)
                        ->update(array('status' => -1));

                $data_result['status'] = 1;
                $data_result['msg'] = "Record deleted successfully.";
            }
        }
        echo json_encode($data_result);
        exit;
    }
    
    public function email_to_users(Request $request) {

        $post = $request->input();
        $data_result = array();
        $data_result['status'] = 0;

        if (!empty($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            if ($id != "") {

               $user =  DB::table('users')
                    ->where('status', '=', 1)
                    ->get();
            print_r($user);exit;
                        
                $data_result['status'] = 1;
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
            2 => 'description',
            3 => 'image_upload',
            4 => 'status',
            5 => 'is_publish',
            6 => 'created_at',
            7 => 'updated_at',
        );

        $select_query = DB::table('bullet')
                ->where('status', '!=', -1);
        
        $select_query->select('*', DB::raw("IF(status = 1,'Active','Inactive') as status"));

        if (isset($requestData['search']['value']) && $requestData['search']['value'] != '') {
            $select_query->where("title", "like", '%' . $requestData['search']['value'] . '%');
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

        $bullet_list = $select_query->get();

        $baseurl = url('/');
        foreach ($bullet_list as $row) {
            
            $id = $row->id;
            $is_publish = $row->is_publish;

            $file = public_path() . "/upload/bullet/thumbnail/" . $row->image_upload;

            if (file_exists($file)) {
                $media = "<div> <img src='" . $baseurl . "/upload/bullet/thumbnail/" . $row->image_upload . "'/></div>";
            } else {
                $media = "<div> <img src='" . $baseurl . "/images/noimage100.png'></div>";
            }
            
            if($row->is_publish == 0)
            {
                $action = '<a href="javascript:void(0);" data-id="' . $id .'" data-publish="'.$is_publish.'" class="btn btn-xs btn-info btn_is_publish"> Publish </a> &nbsp;';
            } else {
                $action = '<a href="javascript:void(0);" data-id="' . $id .'" data-publish="'.$is_publish.'" class="btn btn-xs btn-info btn_is_publish"> Unpublish </a>&nbsp;';
            }
            
            $temp['id'] = $row->id;
            $temp['title'] = $row->title;
            $temp['description'] = $row->description;
            $temp['image_upload'] = $media;
            $temp['created_date'] = $row->created_at;
            $temp['updated_date'] = $row->updated_at;
            $temp['status'] = $row->status;
            $temp['is_publish'] = $row->is_publish;
            

            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-info email_to_users "> Email To users</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-info btnEdit_test"> Edit</a>  	&nbsp;';
            $action .= '<a href="javascript:void(0);" data-id="' . $id . '" class="btn btn-xs btn-danger btnDelete_test"> Delete</a></div>';
            
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
