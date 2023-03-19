<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorerFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explorer_file', function (Blueprint $table) {
            $table->id();

            $table->integer('directory_id')->nullable();
            $table->index('directory_id');
            // $table->foreign('directory_id')->references('id')->on('explorer_directory')->onDelete('cascade');

            $table->integer('creator_id')->nullable();
            $table->index('creator_id');
            // $table->foreign('creator_id')->references('id')->on('user')->onDelete('cascade');

            $table->string('filename');
            $table->string('extension', 10);
            $table->string('size');

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
        Schema::dropIfExists('explorer_file');
    }
}
