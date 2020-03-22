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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone_no')->unique();
            $table->string('email')->unique();

            $table->string('street_address');
            $table->unsignedInteger('division_id')->comment('Division table id');
            $table->unsignedInteger('district_id')->comment('District table id');
            $table->text('ip_address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('shippint_address')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            
            $table->unsignedTinyInteger('status')->default(0)->comment('0=inactive|1=active|2=banned');
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
