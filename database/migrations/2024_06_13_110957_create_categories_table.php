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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable(); 
            $table->string('image_name')->nullable();
            $table->string('button_name')->nullable();
            $table->tinyInteger('is_home')->default(0)->comment('0=Do not show,1=Show');
            $table->tinyInteger('is_menu')->default(0)->comment('0=Do not show,1=Show');
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=active,1=inactive');
            $table->tinyInteger('is_delete')->default(0)->comment('0=not,1=deleted');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
