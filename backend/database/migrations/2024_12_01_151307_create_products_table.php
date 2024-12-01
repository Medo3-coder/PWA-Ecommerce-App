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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->decimal('price', 10, 2); // Price with up to 2 decimal places
            $table->decimal('special_price', 10, 2)->nullable();
            $table->string('image', 255); // Image URL
            $table->string('category', 100)->nullable()->index();
            $table->string('subcategory', 100)->nullable()->index();
            $table->string('remark', 255)->nullable(); // Any remark, optional
            $table->string('brand', 100)->nullable()->index();
            $table->float('star', 2, 1)->nullable();
            $table->string('product_code', 50)->unique();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
