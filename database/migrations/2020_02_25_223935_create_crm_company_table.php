<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_company', function (Blueprint $table) {
            $table->id();

            $table->integer('creator_id')->nullable();
            $table->index('creator_id');
            // $table->foreign('creator_id')->references('id')->on('user');

            $table->string('source');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('interval_employee', 30)->nullable();
            $table->string('city')->nullable();
            $table->string('website')->nullable();
            $table->jsonb('sectors')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->unsignedBigInteger('annual_revenues')->nullable();

            $table->integer('i18n_country_id')->nullable();
            $table->index('i18n_country_id');
            // $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

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
        Schema::dropIfExists('crm_company');
    }
}
