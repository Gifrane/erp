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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();

            $table->integer('crm_company_id')->nullable();
            $table->index('crm_company_id');
            // $table->foreign('crm_company_id')->references('id')->on('crm_company')->onDelete('cascade');

            $table->string('name');
            $table->boolean('is_provider');
            $table->boolean('is_manufacturer');

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
        Schema::dropIfExists('supplier');
    }
};
