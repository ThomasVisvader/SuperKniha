<?php

use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertToPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $payment = new Payment;
        $payment['title'] = 'Kartou online';
        $payment['price'] = 0;
        $payment->save();

        $payment = new Payment;
        $payment['title'] = 'V hotovosti pri prevzatí';
        $payment['price'] = 0;
        $payment->save();

        $payment = new Payment;
        $payment['title'] = 'Kartou pri prevzatí';
        $payment['price'] = 0;
        $payment->save();

        $payment = new Payment;
        $payment['title'] = 'Internet banking';
        $payment['price'] = 0;
        $payment->save();

        $payment = new Payment;
        $payment['title'] = 'Na dobierku';
        $payment['price'] = 1.99;
        $payment->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            //
        });
    }
}
