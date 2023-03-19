<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorerFileMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explorer_file_meta', function (Blueprint $table) {
            $table->id();

            $table->integer('file_id');
            $table->index('file_id');
            // $table->foreign('file_id')->references('id')->on('explorer_file')->onDelete('cascade');

            $table->string('name');
            $table->longText('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('explorer_file_meta');
    }
}
