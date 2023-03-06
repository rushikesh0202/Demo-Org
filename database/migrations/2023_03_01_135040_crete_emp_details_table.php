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
        Schema::create('emp_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->nullable()->constrained('employees');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('mobile');
            $table->string('address');
            $table->softDeletes();
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_details');
    }
};
