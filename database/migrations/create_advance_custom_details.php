<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvanceCustomDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_custom_details', function (Blueprint $table) {
        $table->increments('id');
        $table->string('label');
        $table->string('fild_name');
        $table->string('fild_value');
        $table->tinyInteger('status');
        $table->timestamps();
        });
        
        // Insert some stuff
        DB::table('advance_custom_details')->insert(
            array(
                array(
                'label' => 'logo name',
                'fild_name' => 'logo_name',
                'fild_value' => 'abcd',
                'status' => '1',
                ),
                array(
                'label' => 'logo name1',
                'fild_name' => 'logo_name1',
                'fild_value' => 'abcd1',
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
        Schema::drop('advance_custom_details');
    }
}
