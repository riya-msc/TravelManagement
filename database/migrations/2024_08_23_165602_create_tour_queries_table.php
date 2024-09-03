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
        Schema::create('tour_queries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('starting_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('airline_choice')->nullable();
            $table->string('visiting_country')->nullable();
            $table->string('visiting_cities')->nullable();
            $table->string('airline_ticket_category')->nullable();
            $table->string('number_of_adults');
            $table->string('number_of_children');
            $table->string('accommodation_typer')->nullable();
            $table->string('number_of_rooms')->nullable();
            $table->string('foods_included')->nullable();
            $table->string('guide_required')->nullable();
            $table->string('private_transport')->nullable();
            $table->string('special_requirement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_queries');
    }
};
