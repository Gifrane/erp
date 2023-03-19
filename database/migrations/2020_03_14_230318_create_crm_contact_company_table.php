<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmContactCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contact_company', function (Blueprint $table) {
            $table->id();

            $table->integer('crm_contact_id');
            $table->index('crm_contact_id');
            // $table->foreign('crm_contact_id')->references('id')->on('crm_contact')->onDelete('cascade');

            $table->integer('crm_company_id');
            $table->index('crm_company_id');
            // $table->foreign('crm_company_id')->references('id')->on('crm_company')->onDelete('cascade');

            $table->string('function')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_contact_company');
    }
}
