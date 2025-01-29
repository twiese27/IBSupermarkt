<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id'); // AUTO_INCREMENT Primary Key
            $table->string('forename');
            $table->string('middle_name')->nullable();
            $table->string('lastname');
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('postal_code');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->unique();
            $table->string('iban')->nullable();
            $table->date('birth_date')->nullable();
           // $table->timestamp('created_on')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
