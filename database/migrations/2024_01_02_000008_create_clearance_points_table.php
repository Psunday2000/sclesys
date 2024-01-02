<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearancePointsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clearance_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('unit_id');
            $table->timestamp('date_cleared')->nullable();
            $table->foreignId('cleared_by')->nullable();
            $table->string('status')->default('pending'); // Added status column with default value 'pending'
            $table->timestamps();

            // You can add more columns if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('clearance_points');
    }
}
