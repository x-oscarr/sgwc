<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_disputes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->unsigned();
            $table->text('info');
            $table->string('file')->nullable(true);
            $table->timestamps();
        });

        Schema::table('report_disputes', function(Blueprint $table) {
            $table->foreign('report_id')
                ->references('id')->on('reports')
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
        Schema::dropIfExists('report_disputes');
    }
}
