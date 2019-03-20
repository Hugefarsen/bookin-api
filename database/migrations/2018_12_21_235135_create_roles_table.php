<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('role', ['Admin', 'Supervisor', 'User']);
            $table->timestamps();

        });

        $admin = new App\Role;
        $admin->role = 'Admin';
        $admin->save();

        $supervisor = new App\Role;
        $supervisor->role = 'Supervisor';
        $supervisor->save();

        $user = new App\Role;
        $user->role = 'User';
        $user->save();

        // Insert a adminuser
        \Illuminate\Support\Facades\DB::table('users')->insert(
            array(
                'name' => 'admin',
                'email' => 'admin@bookin.se',
                'password' => '$2y$10$XYBtxbVLWMzmmAPxpM2QJO6tXI9gp2fYU2S01sSuYIY2NO0I1vyZa', //secret
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
        Schema::dropIfExists('roles');
    }
}
