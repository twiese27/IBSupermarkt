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
        Schema::create('user_account', function (Blueprint $table) {
            $table->bigIncrements('user_account_id'); // Entspricht USER_ACCOUNT_ID
            $table->date('password_valid_end'); // Entspricht PASSWORD_VALID_END
            $table->unsignedBigInteger('customer_id'); // Entspricht CUSTOMER_ID
            $table->string('password', 20); // Entspricht PASSWORD (VARCHAR2(20 BYTE))

            // Entspricht PASSWORD_VALID_BEGINN
            $table->date('password_valid_beginn'); 

            // Primärschlüssel erstellen
            $table->primary(
                ['user_account_id', 'password_valid_end', 'password_valid_beginn'],
                'user_account_pk'
            );
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
