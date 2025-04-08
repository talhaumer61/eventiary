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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->integer('event_status')->comment('1: Active, 2: Inactive');
            $table->string('event_name');
            $table->string('event_href');
            $table->string('event_location');
            $table->string('event_detail')->nullable();
            $table->bigInteger('event_budget')->nullable();
            $table->bigInteger('no_of_guests')->nullable();
            $table->timestamp('event_date')->nullable();
            $table->string('event_image')->nullable();
            $table->bigInteger('id_type')->nullable();
            $table->bigInteger('id_added')->nullable();
            $table->bigInteger('id_modify')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamp('date_modify')->nullable();
            $table->boolean('is_deleted')->default(false)->comment('1 = deleted');
            $table->bigInteger('id_deleted')->nullable();
            $table->timestamp('date_deleted')->nullable();
            $table->string('ip_deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
