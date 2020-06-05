<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->text('product_details');
            $table->string('product_color');
            $table->string('product_size');
            $table->decimal('selling_price',8,2);
            $table->decimal('discount_price',8,2)->nullable();
            $table->string('video_link')->nullable();
            $table->tinyInteger('mid_slider')->nullable();
            $table->tinyInteger('trend')->nullable();
            $table->tinyInteger('featured')->nullable();
            $table->tinyInteger('buyone_getone')->nullable();
            $table->integer('view_count')->default('0');
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
