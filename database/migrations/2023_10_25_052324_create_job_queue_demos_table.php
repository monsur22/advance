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
        Schema::create('job_queue_demos', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('Company');
            $table->string('State');
            $table->string('Revenew');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_queue_demos');
    }
};
