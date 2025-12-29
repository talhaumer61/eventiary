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
        Schema::table('event_organizer_assignments', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'paid'])->default('pending')->after('status');
            $table->string('payment_intent_id')->nullable()->after('payment_status');
            $table->string('payment_transaction_id')->nullable()->after('payment_intent_id');
            $table->timestamp('payment_date')->nullable()->after('payment_transaction_id');
        });
    }

    public function down()
    {
        Schema::table('event_organizer_assignments', function (Blueprint $table) {
            $table->dropColumn(['payment_status','payment_intent_id','payment_transaction_id','payment_date']);
        });
    }

};
