<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('set null');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')
                ->references('id')
                ->on('coupons')
                ->onDelete('set null');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('product_colors')
                ->onDelete('set null');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')
                ->references('id')
                ->on('product_sizes')
                ->onDelete('set null');
            $table->string('status')->default('pending');
            $table->double('sub_total_price')->nullable();
            $table->double('shipping_price')->nullable();
            $table->double('final_price')->nullable();
            $table->string('payment_method')->default('cash');
            $table->string('transaction_id')->nullable();
            $table->double('tax_amount')->nullable();
            $table->decimal('tax_percentage',5,2)->nullable();
            $table->double('price_before_coupon')->nullable();
            $table->double('coupon_amount')->nullable();
            $table->longText('user_data')->nullable();
            $table->longText('coupon_data')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
