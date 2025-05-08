<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndStatusToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'category')) {
                 $table->string('category')->nullable()->after('content');
            }
            if (!Schema::hasColumn('posts', 'status')) {
                 $table->enum('status', ['published', 'draft', 'archived'])->default('draft')->after('category');
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['category', 'status']);
        });
    }
}