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
            $table->id();
            $table->integer('store_id')->default(0);
            $table->string('name', 100)->nullable();
            $table->string('phone', 30)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('job_title')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('join_date')->nullable();
            $table->float('salary')->default(0);
            $table->string('nid', 40)->nullable();
            $table->string('img')->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->string('role', 50)->nullable();
            $table->string('username', 70)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
