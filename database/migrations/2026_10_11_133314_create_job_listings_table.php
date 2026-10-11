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
        //Attributes for the job_listings table
        //Renamed table to prevent conflict with internal Laravel job queue table
        //'user_id' set to restrictOnDelete to prevent conflicts with update job_listings rights
        //ToDo: attributes 'salary'(min, max, period)?
        //ToDo: attribute 'currency' default EUR/USD?
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
