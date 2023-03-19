<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_spare_part', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id');
            $table->index('product_id');
            // $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');

            $table->integer('product_used_id')->nullable();
            $table->index('product_used_id');
            // $table->foreign('product_used_id')->references('id')->on('product')->onDelete('cascade');

            $table->string('name');
            $table->index('name');

            $table->integer('supplier_provider_id')->nullable();
            $table->index('supplier_provider_id');
            // $table->foreign('supplier_provider_id')->references('id')->on('supplier')->onDelete('cascade');

            $table->integer('supplier_manufacturer_id')->nullable();
            $table->index('supplier_manufacturer_id');
            // $table->foreign('supplier_manufacturer_id')->references('id')->on('supplier')->onDelete('cascade');

            $table->bigInteger('amount');
            $table->double('price', 12, 2);

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
        Schema::dropIfExists('product_spare_part');
    }
};
