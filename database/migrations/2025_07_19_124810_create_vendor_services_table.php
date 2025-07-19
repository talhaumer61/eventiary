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
        Schema::create('vendor_services', function (Blueprint $table) {
            $table->bigIncrements('service_id');
            $table->string('service_name');
            $table->string('service_href');
            $table->string('service_icon')->nullable();
            $table->string('service_photo')->nullable();
            $table->text('service_desc')->nullable();
            $table->decimal('service_price', 10, 2)->nullable();
            $table->unsignedBigInteger('id_vendor');
            $table->unsignedBigInteger('id_type');
            $table->integer('service_status')->default(1)->comment('1: Active, 2: Inactive');

            $table->bigInteger('id_added')->nullable();
            $table->bigInteger('id_modify')->nullable();
            $table->timestamp('date_added')->nullable();
            $table->timestamp('date_modify')->nullable();
            $table->boolean('is_deleted')->default(false)->comment('1 = deleted');
            $table->bigInteger('id_deleted')->nullable();
            $table->timestamp('date_deleted')->nullable();
            $table->string('ip_deleted')->nullable();

            $table->foreign('id_vendor')->references('id')->on('users');
            $table->foreign('id_type')->references('type_id')->on('vendor_types');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_services');
    }
};
