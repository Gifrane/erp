<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();

            $table->integer('company_id');
            $table->index('company_id');
            // $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');

            $table->string('email');
            $table->index('email');

            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('avatar');
            $table->string('token_enable')->nullable();
            $table->string('role')->nullable();

            $table->boolean('active')->default(false);
            $table->date('enabled_at')->nullable();

            $table->integer('i18n_country_id');
            $table->index('i18n_country_id');
            // $table->foreign('i18n_country_id')->references('id')->on('i18n_country');

            $table->string('lang');
            $table->string('timezone');
            $table->string('date_format', 40);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
