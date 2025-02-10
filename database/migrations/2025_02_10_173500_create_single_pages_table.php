<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('single_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // 用於識別不同的單頁，如 'about', 'contact', 'features'
            $table->string('title');
            $table->string('image')->nullable();
            $table->longText('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('single_pages');
    }
};