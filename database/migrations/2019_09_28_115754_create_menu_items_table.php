<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_module_id')->unsigned()->nullable(true);
            $table->text('text');
            $table->string('route');
            $table->json('route_params')->nullable(true);
            $table->string('access')->nullable(true);
            $table->string('access_params')->nullable(true);
            $table->integer('parent_id')->unsigned()->nullable(true);
            $table->integer('position')->default(0);
        });

        Schema::table('menu_items', function(Blueprint $table) {
            $table->foreign('site_module_id')
                ->references('id')->on('site_modules')
                ->onDelete('cascade');
            $table->foreign('parent_id')
                ->references('id')->on('menu_items')
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
        Schema::dropIfExists('menu_items');
    }
}
