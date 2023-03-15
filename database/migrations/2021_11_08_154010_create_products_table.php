<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->decimal('price', 6, 2);
            $table->decimal('discounted_price', 6, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('rating', 2, 1);
            $table->string('language', 50);
            $table->string('type', 50);
            $table->string('description', 1000);
            $table->string('series', 100)->nullable();
            $table->smallInteger('volume')->nullable();
            $table->string('author', 100);
            $table->string('genre', 100);
            $table->string('format', 50)->nullable();
            $table->string('age_group', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->smallInteger('page_count')->nullable();
            $table->string('isbn', 25)->nullable();
            $table->string('length', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
