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
            $table->text('description' , 255);
            $table->decimal('price', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->decimal('special_price', 10, 2)->nullable();
            $table->string('image', 255); // Image URL
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('subcategory_id')->nullable()->index();
            $table->string('remark', 255)->nullable();
            $table->string('brand', 100)->nullable()->index();
            $table->float('star', 2, 1)->nullable();
            $table->string('product_code', 50)->unique();
            $table->softDeletes();
            $table->timestamps();

             // Foreign key constraints
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
             $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('set null');
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
