<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_pages', function (Blueprint $table) {
            $columns = ['business_name', 'target_market', 'problem', 'solution', 'benefit', 'tone'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('sales_pages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('sales_pages', function (Blueprint $table) {
            $table->string('business_name')->nullable();
            $table->text('target_market')->nullable();
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('benefit')->nullable();
            $table->string('tone')->nullable();
        });
    }
};
