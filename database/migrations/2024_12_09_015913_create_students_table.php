<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('department');
            $table->string('course');
            $table->string('email')->unique();
            $table->string('answered')->default('0');
            $table->string('age')->nullable();
            $table->string('bday')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('current_company')->nullable();
            $table->string('position')->nullable();
            $table->string('employment_duration')->nullable();
            $table->string('employment_date')->nullable();
            $table->string('contact_number_mobile')->nullable();
            $table->string('contact_number_tel')->nullable();
            $table->string('current_address')->nullable();
            $table->string('approved')->default('0')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
};
