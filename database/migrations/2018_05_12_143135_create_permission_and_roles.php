<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });
        Schema::create('admin_permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->default(0);
            $table->integer('permission_id')->default(0);
            $table->timestamps();
        });
        Schema::create('admin_role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->default(0);
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_role_user');
    }
}
