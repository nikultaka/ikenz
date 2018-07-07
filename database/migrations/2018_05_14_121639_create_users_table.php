<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status');
            $table->timestamps();
            });
            
            // Insert some stuff
            DB::table('users')->insert(
                array(
                    'role_id' => 1,
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'password' => '$2y$10$yCQoSMJ4ktGE16kwwTFK8OtWclZRQEOydRK8ceYb.PElk4/vZd/te',
                    'remember_token' => 'BwWVSivqzGfmPjcTFbal2icm0fiBzpQOYVGVXvi1cxr2xM6xzLnOzwlNklwB',
                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s')
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
       Schema::drop('users');
    }
}
