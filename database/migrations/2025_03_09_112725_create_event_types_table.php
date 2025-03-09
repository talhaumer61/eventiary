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
        Schema::create('event_types', function (Blueprint $table) {
            $table->bigIncrements('type_id');
            $table->integer('type_status')->comment('1: Active, 2: Inactive');
            $table->string('type_name');
            $table->string('type_href');
            $table->string('type_icon')->nullable();
            $table->string('type_photo')->nullable();
            $table->string('type_desc')->nullable();
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
        Schema::dropIfExists('event_types');
    }
};
