<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_role', function (Blueprint $table) {
        $table->increments('id');
        $table->string('role_name');
        $table->tinyInteger('status');
        $table->timestamps();
        });

        // Insert some stuff
        DB::table('user_role')->insert(
            array(
                'role_name' => 'Admin',
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
        //
    }
}
