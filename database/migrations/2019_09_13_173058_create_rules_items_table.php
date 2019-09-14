<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rules_categories_id')->unsigned();
            $table->text('text');
            $table->text('penalty')->nullable();
            $table->timestamps();
        });

        Schema::table('rules_items', function($table) {
            $table->foreign('rules_categories_id')
                ->references('id')->on('rules_categories')
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
        Schema::dropIfExists('rules_items');
    }
}
