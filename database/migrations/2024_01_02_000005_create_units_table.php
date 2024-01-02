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
        if (!Schema::hasTable('units')) {
            Schema::create('units', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('clearance_officer')->nullable();
                $table->timestamps();

                // Add foreign key constraint to associate with admins
                $table->foreign('clearance_officer')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['clearance_officer']);
        });

        Schema::dropIfExists('units');
    }
};
