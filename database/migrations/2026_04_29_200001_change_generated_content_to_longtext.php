<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_pages', function (Blueprint $table) {
            $table->longText('generated_content')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sales_pages', function (Blueprint $table) {
            $table->json('generated_content')->nullable()->change();
        });
    }
};
