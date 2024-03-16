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
        Schema::create('variant_details', function (Blueprint $table) {
            $table->id();
            $table->integer('product_variant_type_id');
            $table->integer('product_id');
            $table->string('variant_value');
            $table->float('price');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('is_default', ['yes', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_details');
    }
};
