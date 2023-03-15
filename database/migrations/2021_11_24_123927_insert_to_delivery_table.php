<?php

use App\Models\Delivery;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertToDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $delivery = new Delivery;
        $delivery['title'] = 'Kuriérom';
        $delivery['price'] = 2.99;
        $delivery->save();

        $delivery = new Delivery;
        $delivery['title'] = 'Osobný odber';
        $delivery['price'] = 0;
        $delivery->save();

        $delivery = new Delivery;
        $delivery['title'] = 'Slovenská pošta (na poštu)';
        $delivery['price'] = 2.69;
        $delivery->save();

        $delivery = new Delivery;
        $delivery['title'] = 'Slovenská pošta (na adresu)';
        $delivery['price'] = 2.69;
        $delivery->save();

        $delivery = new Delivery;
        $delivery['title'] = 'Zásielkovňa';
        $delivery['price'] = 1.99;
        $delivery->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery', function (Blueprint $table) {
            //
        });
    }
}
