<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // payments table
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->unsignedBigInteger('id_from');
            $table->unsignedBigInteger('id_to');
            $table->unsignedBigInteger('event_id');

            $table->bigInteger('total_amount');
            $table->bigInteger('advance_amount');
            $table->bigInteger('commission');
            $table->bigInteger('amount_transferred');

            $table->string('payment_intent_id')->nullable();
            $table->string('transfer_id')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('released_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
