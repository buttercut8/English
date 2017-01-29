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
            $table->string('avatar',80)->default('avatar.png');
            $table->string('facebook',100)->nullable();
            $table->string('skype',100)->nullable();
            $table->string('twitter',100)->nullable();
            $table->text('about_me')->nullable();
            $table->string('name',60);
            $table->string('phone',12)->unique();
            $table->string('email',60)->unique();
            $table->string('password',100);
            $table->ipAddress('ip_address');
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
