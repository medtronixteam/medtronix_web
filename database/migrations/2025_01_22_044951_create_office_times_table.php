<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('open_time');
            $table->time('close_time');
            $table->time('max_reporting_time');
            $table->timestamps();
            $table->string('min_reporting_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_times');
    }
};
