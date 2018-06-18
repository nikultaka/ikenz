<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class Contact_us extends Model
//{
//    public function get_value_by_option_name($option_name){
//        return DB::table('site_setting_option')->where('option_name','=',$option_name)->get();
//    }
////    public function update_value_by_option_name($option_name,$option_value){
////         $current_date_time=date("Y-m-d h:i:sa");
////       return DB::table('site_setting_option') ->where('option_name','=',$option_name)
////                                            ->update(['option_value' => $option_value,'updated_date'=>$current_date_time]);
////            
////    }
////    public function insert_value_site_setting($data){
////        DB::table('site_setting_option')->insert($data);
////    }
//}
{
    protected $primaryKey = 'id';
    protected $table = 'contact_us';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_us',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}