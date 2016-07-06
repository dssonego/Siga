<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('zipcode');
            $table->string('street');
            $table->string('complement');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_addresses');
    }
}
