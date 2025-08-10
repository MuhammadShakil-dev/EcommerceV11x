<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * 
     */
    public function up(): void 
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('stripe_session_id')->nullable();
            $table->string('order_number')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('country')->nullable();
            $table->string('street_address_one')->nullable();
            $table->string('street_address_two')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->longText('notes')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_amount')->default(0);
            $table->integer('shipping_id')->nullable();
            $table->string('shipping_amount')->default(0);
            $table->string('total_amount')->default(0);
            $table->string('payment_method')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Pending,1=Inprogress,2=deliver,3=Completed,4=Cancelled');
            $table->tinyInteger('is_delete')->default(0)->comment('0=not delete,1=deleted');
            $table->tinyInteger('is_payment')->default(0)->comment('0=not payment,1=payment done');
            $table->text('payment_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
