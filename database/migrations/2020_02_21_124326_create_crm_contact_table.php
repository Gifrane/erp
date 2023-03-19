<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contact', function (Blueprint $table) {
            $table->id();

            $table->string('source');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();

            $table->string('email');
            $table->index('email');

            $table->string('phone')->nullable();

            $table->integer('i18n_country_id')->nullable();
            $table->index('i18n_country_id');
            // $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

            $table->integer('creator_id')->nullable();
            $table->index('creator_id');
            // $table->foreign('creator_id')->references('id')->on('user');

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
        Schema::dropIfExists('crm_contact');
    }
}
