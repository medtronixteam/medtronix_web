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
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('salary_month');
            $table->string('salary_year');
            $table->decimal('basic_salary', 10);
            $table->decimal('total_salary', 10);
            $table->decimal('transport_allowance', 10);
            $table->text('other_allowance');
            $table->decimal('income_tax', 10);
            $table->text('other_deduction');
            $table->decimal('absent_deduction', 10)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_slips');
    }
};
