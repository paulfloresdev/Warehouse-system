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
        Schema::create('out_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
            ->onUpdate('cascade')->onDelete('restrict'); 
            $table->foreignId('asset_id')->constrained('assignable_assets')
            ->onUpdate('cascade')->onDelete('restrict'); 
            $table->date('init_date');
            $table->date('end_date');
            $table->boolean('auth');
            $table->boolean('in_office');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('out_passes');
    }
};
