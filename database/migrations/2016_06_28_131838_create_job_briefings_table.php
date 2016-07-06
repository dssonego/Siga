<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobBriefingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_briefings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->longText('briefing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_briefings');
    }
}
