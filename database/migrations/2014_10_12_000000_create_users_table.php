<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('main_language')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->string('password');
            $table->string('token')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('current_location')->nullable();
            $table->boolean('current_location_status')->default(false);
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->enum('type', ['user', 'admin'])->nullable();
            $table->string('paypal')->nullable();
            $table->boolean('status')->default(true);
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
