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
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id(); 
            $table->string('trendy_product_title')->nullable();
            $table->string('shop_category_title')->nullable();
            $table->string('recenta_arrival_title')->nullable();
            $table->string('blog_title')->nullable();
            $table->string('payment_delivery_title')->nullable();
            $table->string('payment_delivery_description')->nullable();
            $table->string('payment_delivery_image')->nullable();
            $table->string('refund_title')->nullable();
            $table->string('refund_description')->nullable();
            $table->string('refund_image')->nullable();
            $table->string('support_title')->nullable();
            $table->string('support_description')->nullable();
            $table->string('support_image')->nullable();
            $table->string('signup_title')->nullable();
            $table->string('signup_description')->nullable();
            $table->string('signup_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
