<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('slug_url')->unique();
        $table->text('description');
        $table->string('meta_title')->nullable();
        $table->string('meta_keyword')->nullable();
        $table->text('meta_description')->nullable();
        $table->tinyInteger('status');
        $table->timestamps();
        });
        
        // Insert some stuff
        DB::table('cms')->insert(
            array(
                'title' => 'Home',
                'slug_url' => 'home',
                'description' => 'Home description goes here..',
                'meta_title' => 'Home',
                'meta_keyword' => '',
                'meta_description' => '',
                'status' => '1',
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
        Schema::drop('cms');
    }
}
