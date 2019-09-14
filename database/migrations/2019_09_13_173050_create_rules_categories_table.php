<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('title');
            $table->text('description');
            $table->string('type');
            $table->boolean('is_selectable')->default(true);
            $table->timestamps();
        });

        Schema::table('rules_categories', function($table) {
            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');

            $table->foreign('parent_id')
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
        Schema::dropIfExists('rules_categories');
    }
}
