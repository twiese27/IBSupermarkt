<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_account_id'); // Entspricht USER_ACCOUNT_ID
            $table->date('password_valid_end'); // Entspricht PASSWORD_VALID_END
            $table->unsignedBigInteger('customer_id'); // Entspricht CUSTOMER_ID
            $table->string('password', 20); // Entspricht PASSWORD (VARCHAR2(20 BYTE))


            // Primärschlüssel erstellen
            $table->primary('user_account_id');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('user_account_id')->primary();
            $table->string('customer_id')->nullable()->index();
            $table->string('password_valid_begin')->nullable();;
            $table->string('password_valid_end')->nullable();;
            $table->string('password')->nullable();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
