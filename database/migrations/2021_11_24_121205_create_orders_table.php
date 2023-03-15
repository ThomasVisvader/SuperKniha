<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('paid_at')->nullable();
            $table->decimal('products_price', 7, 2)->nullable();
            $table->bigInteger('delivery_method')->nullable();
            $table->foreign('delivery_method')->references('id')->on('delivery');
            $table->bigInteger('payment_method')->nullable();
            $table->foreign('payment_method')->references('id')->on('payment');
            $table->decimal('total_price', 8, 2)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('e_mail', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->string('country', 100)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
