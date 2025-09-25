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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('sort_number')->nullable();
            $table->string('item_code')->nullable();
            $table->string('register')->nullable();
            $table->string('name')->nullable();
            $table->string('merk')->nullable();
            $table->string('machine_number')->nullable();
            $table->string('material')->nullable();
            $table->string('acquisition_source')->nullable();
            $table->string('acquisition_year')->nullable();
            $table->string('specification')->nullable();
            $table->string('unit')->nullable();
            $table->string('condition')->nullable();
            $table->integer('qty')->default(0);
            $table->integer('price')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
