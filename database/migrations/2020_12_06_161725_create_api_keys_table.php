<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();

            $table->integer('generated_by_user_id')->nullable();
            $table->index('generated_by_user_id');
            // $table->foreign('generated_by_user_id')->references('id')->on('user');

            $table->string('name');
            $table->index('name');

            $table->string('public_key');
            $table->string('private_key');

            $table->date('expired_at')->nullable();
            $table->jsonb('modules')->nullable();

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
        Schema::dropIfExists('api_keys');
    }
}
