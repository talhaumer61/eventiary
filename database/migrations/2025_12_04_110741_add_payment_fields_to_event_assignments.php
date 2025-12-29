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
        $table->boolean('payment_released')->default(false);
        $table->timestamp('released_date')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_assignments', function (Blueprint $table) {
            //
        });
    }
};
