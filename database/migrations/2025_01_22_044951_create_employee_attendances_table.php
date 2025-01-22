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
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('attendance_date');
            $table->double('extra_hours')->default(0);
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('user_id')->index('employee_attendances_user_id_foreign');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('employee_attendances');
    }
};
