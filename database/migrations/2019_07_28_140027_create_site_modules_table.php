<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable(true);
            $table->string('version')->nullable(true);
            $table->string('slug');
            $table->integer('plugin_module_id')->unsigned()->nullable(true);
            $table->boolean('is_enabled')->default(true);
        });

        Schema::table('site_modules', function(Blueprint $table) {
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
        Schema::dropIfExists('site_modules');
    }
}
