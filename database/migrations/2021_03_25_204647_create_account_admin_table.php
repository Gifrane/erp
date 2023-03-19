<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_admin', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id');
            $table->index('user_id');
            // $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            $table->integer('giver_id')->nullable();
            $table->index('giver_id');
            // $table->foreign('giver_id')->references('id')->on('user')->onDelete('cascade');

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
        Schema::dropIfExists('account_admin');
    }
}
