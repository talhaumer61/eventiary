<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id'); // notification for this user
        $table->string('title');
        $table->text('message')->nullable();

        $table->boolean('is_read')->default(0);

        $table->string('link')->nullable(); // where user will be redirected when clicked

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
