<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // t,s
            $table->string('unique_id'); // t,s
            $table->string('email')->unique(); // t,s
            $table->string('parent_contact')->nullable(); // s
            $table->string('password'); // t,s
            $table->string('full_name'); //t,s
            $table->enum('gender',['Male','Female'])->nullable(); // t
            $table->date('dob')->nullable(); // s
            $table->date('date_of_join')->nullable(); // t,s
            $table->double('salary_per_hour')->nullable(); // t
            $table->integer('weekly_max_hour')->nullable(); // s
            $table->integer('daily_max_hour')->nullable(); // s
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
