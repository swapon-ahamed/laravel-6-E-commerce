<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('name');
            $table->string('ip_address')->nullable();
            $table->string('phone_no');
            $table->text('shipping_address');
            $table->text('message')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_seen_by_admin')->default(0);
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')
            //       ->references('id')->on('users')
            //       ->onDelete('cascade');

            // $table->engine = 'InnoDB';
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
