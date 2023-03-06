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
        Schema::create('company', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('name');
            $table->string('industry');            
            $table->string('address');            
            $table->string('mobile');            
            $table->string('phone');            
            $table->string('fax');
            $table->softDeletes();               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
