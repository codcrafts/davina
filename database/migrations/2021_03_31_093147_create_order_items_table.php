<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->double('product_price')->nullable();
            $table->double('total_price')->nullable();
            $table->longText('product_data')->nullable();
            $table->boolean('is_offered')->nullable()->default(0);
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('product_colors')
                ->onDelete('cascade');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')
                ->references('id')
                ->on('product_sizes')
                ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('order_items');
    }
}
