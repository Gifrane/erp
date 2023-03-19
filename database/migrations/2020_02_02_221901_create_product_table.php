<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id')->nullable();
            $table->index('parent_id');
            // $table->foreign('parent_id')->references('id')->on('product')->onDelete('cascade');

            $table->string('name');
            $table->index('name');

            $table->string('family')->nullable();
            $table->unsignedBigInteger('price_before_tax')->nullable();
            $table->unsignedBigInteger('price_with_tax')->nullable();
            $table->double('tva', 2, 2)->nullable();
            $table->string('subscription_period')->nullable();
            $table->double('fabrication_cost', 12, 2)->nullable();
            $table->date('started_at')->nullable();
            $table->date('stopped_at')->nullable();

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
        Schema::dropIfExists('product');
    }
}
