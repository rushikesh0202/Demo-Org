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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();            
            $table->string('industry')->nullable();            
            $table->string('address')->nullable();            
            $table->string('mobile')->nullable();            
            $table->string('phone')->nullable();            
            $table->string('fax')->nullable();
            $table->string('password');
            $table->string('api_token', 80)
                        ->unique()
                        ->nullable()
                        ->default(null);
            $table->softDeletes();               
            $table->timestamps();
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
