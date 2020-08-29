<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_module_id')->unsigned()->nullable(true);
            $table->integer('plugin_module_id')->unsigned()->nullable(true);
            $table->boolean('is_global')->default(1);
            $table->string('parameter');
            $table->text('value')->nullable(true);
        });

        Schema::table('settings', function(Blueprint $table) {
            $table->foreign('site_module_id')
                ->references('id')->on('site_modules')
                ->onDelete('cascade');
            $table->foreign('plugin_module_id')
                ->references('id')->on('plugin_modules')
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
        Schema::dropIfExists('settings');
    }
}
