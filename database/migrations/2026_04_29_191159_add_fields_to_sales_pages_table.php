<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('sales_pages', 'business_name')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->string('business_name')->nullable()->after('id');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'product_name')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->string('product_name')->nullable()->after('business_name');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'target_market')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->text('target_market')->nullable()->after('product_name');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'problem')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->text('problem')->nullable()->after('target_market');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'solution')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->text('solution')->nullable()->after('problem');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'benefit')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->text('benefit')->nullable()->after('solution');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'price')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->string('price')->nullable()->after('benefit');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'tone')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->string('tone')->nullable()->after('price');
            });
        }

        if (!Schema::hasColumn('sales_pages', 'generated_content')) {
            Schema::table('sales_pages', function (Blueprint $table) {
                $table->longText('generated_content')->nullable()->after('tone');
            });
        }
    }

    public function down(): void
    {
        Schema::table('sales_pages', function (Blueprint $table) {
            $columns = [
                'business_name',
                'product_name',
                'target_market',
                'problem',
                'solution',
                'benefit',
                'price',
                'tone',
                'generated_content',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('sales_pages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};