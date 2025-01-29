<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('et_login_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('login_type');
            $table->bigInteger('id_user');
            $table->string('user_name', 75);
            $table->string('user_pass', 100);
            $table->string('email', 75);
            $table->dateTime('dated');
            $table->string('ip');
            $table->string('device_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('et_login_history');
    }
};
