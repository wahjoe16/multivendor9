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
            $table->integer('section_id');
            $table->integer('category_id');
            $table->integer('brand_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('admin_type')->nullable();
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('product_color');
            $table->float('product_price');
            $table->float('product_discount')->nullable();
            $table->integer('product_weight')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_image')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured', ['No', 'Yes']);
            $table->tinyInteger('status');
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
