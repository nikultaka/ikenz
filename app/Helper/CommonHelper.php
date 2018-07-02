<?php
namespace App\Helper;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
 
class CommonHelper {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    private static $breadcrumn_data = [];
    public static function add_breadcrumb($pagename, $url = '') {
        
        $temp_array = array();
        $temp_array['name'] = $pagename;
        $temp_array['url'] = $url;
        self::$breadcrumn_data[] = $temp_array;
    }
    
    public static function get_breadcrumb()
    {
        $breadcrumb_str = '';
        $breadcrumb_str .= '<ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="'.URL::to('/admin/dashboard').'">Home</a></li>';
        if(!empty(self::$breadcrumn_data)){
            foreach(self::$breadcrumn_data as $breadcrumb){
                $breadcrumb_str .= '<li class="breadcrumb-item"><a href="'.$breadcrumb['url'].'">'.$breadcrumb['name'].'</a></li>';
            }
        }
        $breadcrumb_str .= '</ol>';
        return $breadcrumb_str;
    }
}