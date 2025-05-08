<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('category')->default('uncategorized'); // Added category with default value
            $table->enum('status', ['published', 'draft', 'archived'])->default('draft'); // Added status with default value
            $table->string('featured_image')->nullable(); //added featured image
            $table->timestamps();
            $table->timestamp('published_at')->nullable(); //added published at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
