<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();

            $table->integer('creator_id')->nullable();
            $table->index('creator_id');
            // $table->foreign('creator_id')->references('id')->on('user')->onDelete('cascade');

            $table->string('billing_id');
            $table->index('billing_id');

            $table->string('direction', 10);
            $table->string('title')->nullable();
            $table->unsignedBigInteger('amount_ht');
            $table->unsignedBigInteger('amount_ttc');
            $table->dateTime('emitted_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('step');

            $table->string('receiver')->nullable();
            $table->nullableMorphs('receiver');

            $table->string('emitter')->nullable();
            $table->nullableMorphs('emitter');

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
        Schema::dropIfExists('billing');
    }
}
