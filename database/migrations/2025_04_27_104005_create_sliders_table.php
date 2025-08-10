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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id(); 
            $table->string('title')->nullable();
            $table->string('image_name')->nullable();
            $table->string('button_name')->nullable();
            $table->string('button_link')->nullable();
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
        Schema::dropIfExists('sliders');
    }
};
