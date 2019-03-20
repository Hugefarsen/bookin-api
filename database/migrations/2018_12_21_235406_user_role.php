<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        });

        \Illuminate\Support\Facades\DB::table('user_roles')->insert(array(
            'user_id' => '1',
            'role_id' => '1'
        ));

        \Illuminate\Support\Facades\DB::table('user_roles')->insert(array(
            'user_id' => '1',
            'role_id' => '2',
        ));

        \Illuminate\Support\Facades\DB::table('user_roles')->insert(array(
            'user_id' => '1',
            'role_id' => '3',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}