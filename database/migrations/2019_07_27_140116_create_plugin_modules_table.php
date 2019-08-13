<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('server_id')->unsigned();
            $table->string('plugin');
            $table->string('db');
            $table->string('db_host');
            $table->string('db_port');
            $table->string('db_username');
            $table->string('db_password');
            $table->boolean('is_enabled');
        });

        Schema::table('plugin_modules', function($table) {
            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugin_modules');
    }
}
