<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permission', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id');
            $table->index('user_id');
            // $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            $table->integer('module_id')->nullable();
            $table->index('module_id');
            // $table->foreign('module_id')->references('id')->on('module')->onDelete('cascade');

            $table->string('permission');
            $table->index('permission');

            $table->string('type');
            $table->text('value');

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
        Schema::dropIfExists('user_permission');
    }
}
