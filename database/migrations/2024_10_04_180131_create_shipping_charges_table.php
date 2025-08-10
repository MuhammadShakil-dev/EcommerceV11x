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
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            // $table->double('price')->default(0.0)->nullable();
            $table->double('price')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=active,1=inactive');
            $table->tinyInteger('is_delete')->default(0)->comment('0=not delete,1=deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_charges');
    }
};
