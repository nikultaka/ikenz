<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_setting', function (Blueprint $table) {
        $table->increments('id');
        $table->string('option_name')->unique();
        $table->longText('option_value');
        $table->tinyInteger('status');
        $table->timestamps();
        });
        
        // Insert some stuff
        DB::table('site_setting')->insert(
            array(
                array(
                'option_name' => 'site_title',
                'option_value' => 'palladium Hub',
                'status' => '1',
                ),
                array(
                    'option_name' => 'user_email',
                    'option_value' => 'no-reply@site.com',
                    'status' => '1',
                ),
                array(
                    'option_name' => 'smtp_host',
                    'option_value' => 'localhost',
                    'status' => '1',
                ),
                array(
                    'option_name' => 'smtp_email',
                    'option_value' => 'no-reply@site.com',
                    'status' => '1',
                ),
                array(
                    'option_name' => 'smtp_password',
                    'option_value' => '',
                    'status' => '1',
                ),    
                array(
                    'option_name' => 'smtp_port',
                    'option_value' => '25',
                    'status' => '1',
                )
                )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_setting');
    }
}
