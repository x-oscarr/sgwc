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
            $table->string('access');
            $table->string('main_element');
            $table->string('route');
            $table->string('menu_alt_element');
            $table->string('alt_route');
            $table->json('data');
            $table->boolean('is_enabled');
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
