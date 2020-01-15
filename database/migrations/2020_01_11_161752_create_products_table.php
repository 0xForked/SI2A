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
            $table->bigIncrements('id');
            $table->string('sku'); // Stock keeping unit / nomor serial produk
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('bets_number');
            $table->string('marketing_authorization_number');
            $table->string('expired_date');
            $table->bigInteger('stock')->default(0);
            $table->bigInteger('price')->nullable();
            $table->bigInteger('unit_id')->unsigned()->index()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->index()->nullable();
            $table->enum('status', [
                'ACTIVE',
                'DEACTIVE'
            ])->default('ACTIVE');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');

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


//  ref : http://ditjenpp.kemenkumham.go.id/arsip/bn/2018/bn1599-2018.pdf