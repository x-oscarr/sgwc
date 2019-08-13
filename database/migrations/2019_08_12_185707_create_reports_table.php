<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id')->unsigned();
            $table->string('type');
            $table->text('description');
            $table->string('sender')->nullable(true);
            $table->integer('sender_id')->unsigned()->nullable(true);
            $table->string('perpetrator')->nullable(true);
            $table->integer('perpetrator_id')->unsigned()->nullable(true);
            $table->string('file')->nullable(true);
            $table->boolean('status')->nullable(true);
            $table->timestamp('time');
            $table->timestamps();
        });

        Schema::table('reports', function($table) {
            $table->foreign('server_id')
                ->references('id')->on('servers')
                ->onDelete('cascade');

            $table->foreign('perpetrator_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('reports');
    }
}
