<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id')->default(0);
            $table->integer('product_id');
            $table->integer('supplier_id');
            $table->float('purchase_price');
            $table->float('sell_price');
            $table->integer('rack_id')->default(0);
            $table->date('expiration_date')->nullable();
            $table->date('alert_date')->nullable();
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
        Schema::dropIfExists('stock_ins');
    }
}
