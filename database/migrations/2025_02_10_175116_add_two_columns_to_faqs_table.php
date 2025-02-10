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
        Schema::table('faqs', function (Blueprint $table) {
            // 增加 is_active 欄位
            $table->boolean('is_active')->default(true);
            // 增加 sort 欄位
            $table->integer('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            // 刪除 is_active 欄位
            $table->dropColumn('is_active');
            // 刪除 sort 欄位
            $table->dropColumn('sort');
        });
    }
};
