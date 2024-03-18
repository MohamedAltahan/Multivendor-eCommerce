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
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('product_variant_detail_id')->constrained('variant_details');
            $table->foreignId('product_variant_type_id');
            $table->unsignedFloat('variant_price')->default(0);
            $table->text('variant_image')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->enum('is_default', ['yes', 'no']);
            $table->unsignedInteger('quantity')->nullable();
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
