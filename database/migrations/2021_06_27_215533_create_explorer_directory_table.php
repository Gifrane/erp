<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplorerDirectoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explorer_directory', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id')->nullable();
            $table->index('parent_id');
            // $table->foreign('parent_id')->references('id')->on('explorer_directory')->onDelete('cascade');

            $table->integer('creator_id');
            $table->index('creator_id');
            // $table->foreign('creator_id')->references('id')->on('user')->onDelete('cascade');

            $table->string('name');

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
        Schema::dropIfExists('explorer_directory');
    }
}
