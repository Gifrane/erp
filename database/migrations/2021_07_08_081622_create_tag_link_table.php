<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_link', function (Blueprint $table) {
            $table->id();

            $table->integer('tag_id');
            $table->index('tag_id');
            // $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');

            $table->morphs('entity');
            $table->nullableMorphs('parent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_link');
    }
}
