<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBulletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bullet', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('description');
        $table->string('image_upload');
        $table->tinyInteger('is_publish');
        $table->tinyInteger('status');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
