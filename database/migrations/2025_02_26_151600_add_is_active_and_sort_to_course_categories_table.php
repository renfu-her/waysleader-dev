<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('description');
            $table->integer('sort')->default(0)->after('is_active');
        });
    }

    public function down()
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'sort']);
        });
    }
};
