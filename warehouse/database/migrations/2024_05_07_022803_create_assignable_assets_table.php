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
        Schema::create('assignable_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('brand', 64);
            $table->string('model', 128);
            $table->string('description', 1024);
            $table->string('serial_number', 48)->unique();
            $table->string('barcode', 20)->unique();
            $table->date('purchase_date');
            $table->double('purchase_price');
            $table->string('condition', 24);
            $table->boolean('out_pass');
            $table->string('rack',16);
            $table->string('shelf',16);
            $table->string('box',16);
            $table->foreignId('supplier_id')->constrained('suppliers')
                ->onUpdate('cascade')->onDelete('restrict'); 
            $table->foreignId('type_id')->constrained('asset_types')
            ->onUpdate('cascade')->onDelete('restrict');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignable_assets');
    }
};
