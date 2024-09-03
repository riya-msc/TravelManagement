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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_code');
            $table->string('package_name');
            $table->string('country');
            $table->string('city');
            $table->string('package_duration');
            $table->string('package_price');
            $table->string('package_rating');
            $table->string('package_person');
            $table->string('validity');
            $table->text('package_itinerary')->nullable();
            $table->text('package_inq_exc')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('other_details')->nullable();
            $table->mediumText('visa_requirements')->nullable();
            $table->string('package_banner')->nullable();
            $table->text('package_images')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
