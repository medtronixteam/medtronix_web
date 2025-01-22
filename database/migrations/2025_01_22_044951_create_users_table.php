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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('picture')->nullable();
            $table->text('about')->nullable();
            $table->string('user_skills')->nullable();
            $table->string('designation')->nullable();
            $table->string('role')->default('user');
            $table->integer('order')->nullable();
            $table->string('cnic')->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('github')->nullable();
            $table->string('skype')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->unsignedInteger('basic_salary')->nullable();
            $table->unsignedInteger('current_salary')->nullable();
            $table->boolean('show_in_website')->default(true);
            $table->boolean('show_in_attendence')->default(true);
            $table->boolean('ip_required')->default(true);
            $table->enum('is_disabled', ['yes', 'no'])->default('no');
            $table->integer('team_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
