<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('companies', function (Blueprint $table) {
            $table->id('idcompanies');
            $table->string('commercial name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first name');
            $table->string('last name');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->bigInteger('zip');
            $table->bigInteger('tax number');
            $table->string('language');
            $table->bigInteger('commercial number');
            $table->string('address 1');
            $table->string('address 2');
            $table->binary('logo');
            $table->integer('role');
            $table->integer('verified')->nullable();
            $table->string('documents')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
