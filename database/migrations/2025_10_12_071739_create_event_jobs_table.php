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
        Schema::create('event_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('href')->unique()->nullable(); // SEO-friendly URL
            $table->text('description');
            $table->string('category')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['open', 'closed', 'in_progress', 'completed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_jobs');
    }
};
