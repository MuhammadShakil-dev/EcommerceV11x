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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id(); 
            $table->string('paypal_id')->nullable();
            $table->string('paypal_status')->default('sendbox')->comment('sendbox id');
            $table->string('stripe_public_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->tinyInteger('is_cash_delivery')->default(1)->comment('1=show, 0= not show');
            $table->tinyInteger('is_paypal')->default(1)->comment('1=show, 0= not show');
            $table->tinyInteger('is_stripe')->default(1)->comment('1=show, 0= not show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
