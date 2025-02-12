<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('職稱');
            $table->string('name')->comment('姓名');
            $table->enum('sex', ['male', 'female'])->comment('性別');
            $table->string('mobile')->nullable()->comment('手機');
            $table->text('content')->nullable()->comment('介紹內容');
            $table->string('address')->nullable()->comment('地址');
            $table->string('image')->nullable()->comment('照片');
            $table->boolean('is_active')->default(true)->comment('是否啟用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
