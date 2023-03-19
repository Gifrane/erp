<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmContactGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_contact_group', function (Blueprint $table) {
            $table->id();

            $table->integer('crm_contact_id');
            $table->index('crm_contact_id');
            // $table->foreign('crm_contact_id')->references('id')->on('crm_contact')->onDelete('cascade');

            $table->integer('crm_group_id');
            $table->index('crm_group_id');
            // $table->foreign('crm_group_id')->references('id')->on('crm_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_contact_group');
    }
}
