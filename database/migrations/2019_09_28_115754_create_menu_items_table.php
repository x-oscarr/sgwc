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
            $table->integer('site_module_id')->unsigned();
            $table->text('text');
            $table->string('route');
            $table->json('route_params')->nullable();
            $table->string('access')->nullable();
            $table->string('access_params')->nullable();
            $table->string('child_id')->nullable();
            $table->integer('position')->default(0);
        });

        Schema::table('menu_items', function($table) {
            $table->foreign('site_module_id')
                ->references('id')->on('site_modules')
                ->onDelete('cascade');
            $table->foreign('child_id')
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
