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
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('package_id');
            $table->string('user_id');
            $table->string('traveller_email');
            $table->string('traveller_phone');
            $table->string('number_of_adult')->nullable();
            $table->string('number_of_child')->nullable();
            $table->string('adult_infos')->nullable();
            $table->string('child_infos')->nullable();
            $table->string('coupon')->nullable();
            $table->string('journey_date')->nullable();
            $table->string('other_requirements')->nullable();
            $table->string('medical_consultation')->nullable();
            $table->string('booking_status')->nullable()->default(0);
            $table->string('total_amount')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('advanced_amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('due_payment_date')->nullable();
            $table->string('payment_status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
