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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_type_id')->constrained('product_variant_types');
            $table->string('attribute');
            $table->string('attribute_code');
            $table->string('value');
            $table->string('product_key');
            $table->float('price');
            $table->float('offer_price');
            $table->integer('quantity');
            $table->boolean('is_default');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
