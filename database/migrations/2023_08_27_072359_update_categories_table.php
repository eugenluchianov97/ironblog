<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_ro')->nullable();
            $table->string('name_en')->nullable();
            $table->string('description_ro')->nullable();
            $table->string('description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_ro');
            $table->dropColumn('name_en');
            $table->dropColumn('description_ro');
            $table->dropColumn('description_en');
        });
    }
};
