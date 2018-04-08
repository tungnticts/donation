<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientIdPaymentTypeStatusToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->char('first_name', 100);
            $table->char('last_name', 100);
            $table->char('email', 100);
            $table->char('address', 250);
            $table->char('city', 250);
            $table->char('phone_number', 20);
            $table->integer('payment_type');
            $table->integer('payment_status');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
