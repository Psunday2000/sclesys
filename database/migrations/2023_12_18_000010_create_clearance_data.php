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
        Schema::create('clearance_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('registration_number')->nullable();
            $table->string('name_of_student')->nullable();
            $table->string('programme')->nullable();
            $table->text('library_card_image')->nullable();
            $table->text('id_card_image')->nullable();
            $table->text('convocation_fee_rrr')->nullable();
            $table->text('first_year_school_fees_image')->nullable();
            $table->text('second_year_school_fees_image')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearance_data');
    }
};
