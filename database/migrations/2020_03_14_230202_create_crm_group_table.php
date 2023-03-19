<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_group', function (Blueprint $table) {
            $table->id();

            $table->string('source');

            $table->string('name');
            $table->index('name');

            $table->text('description')->nullable();
            $table->text('filters')->nullable();

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
        Schema::dropIfExists('crm_group');
    }
}
