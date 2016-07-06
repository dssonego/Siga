<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('code')->unique();
            $table->integer('part_id')->unsigned();
            $table->foreign('part_id')->references('id')->on('job_parts');
            $table->string('title');
            $table->date('deadline');
            $table->string('hour');
            $table->integer('responsable_id')->unsigned();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->integer('requester_id')->unsigned();
            $table->foreign('requester_id')->references('id')->on('users');
            $table->integer('situation_id')->unsigned();
            $table->foreign('situation_id')->references('id')->on('job_situations');
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
        Schema::drop('jobs');
    }
}
