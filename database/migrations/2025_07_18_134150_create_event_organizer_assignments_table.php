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
        Schema::create('event_organizer_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('organizer_id');
            $table->tinyInteger('status')->default(3); // 1 = accepted, 2 = rejected, 3 = pending
            $table->text('description')->nullable();
            $table->bigInteger('id_added')->nullable();
            $table->bigInteger('id_modify')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamp('date_modify')->nullable();
            $table->boolean('is_deleted')->default(false)->comment('1 = deleted');
            $table->bigInteger('id_deleted')->nullable();
            $table->timestamp('date_deleted')->nullable();
            $table->string('ip_deleted')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_organizer_assignments');
    }
};
