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
            $table->string('username');
            $table->string('steamid');
            $table->string('avatar')->nullable(true);;
            $table->string('avatar_md')->nullable(true);;
            $table->string('avatar_sm')->nullable(true);;
            $table->string('url');
            $table->string('realname')->nullable(true);
            $table->string('location')->nullable(true);;
            $table->string('steam32');
            $table->string('steam3');
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
        Schema::dropIfExists('users');
    }
}
