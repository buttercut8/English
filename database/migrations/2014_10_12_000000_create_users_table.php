<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('background',80)->default('background.jpg');
            $table->string('avatar',160)->default('avatar.png');
            $table->string('facebook',120)->nullable();
            $table->string('skype',120)->nullable();
            $table->string('twitter',120)->nullable();
            $table->text('about_me')->nullable();
            $table->string('name',60)->nullable();
            $table->string('phone',12)->unique()->nullable();
            $table->string('email',60)->unique()->nullable();
            $table->string('password',100)->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
