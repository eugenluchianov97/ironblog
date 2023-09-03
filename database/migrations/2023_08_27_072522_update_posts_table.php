<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_ro')->nullable();
            $table->string('title_en')->nullable();
            $table->string('content_ro')->nullable();
            $table->string('content_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title_ro');
            $table->dropColumn('title_en');
            $table->dropColumn('content_ro');
            $table->dropColumn('content_en');
        });
    }
};
