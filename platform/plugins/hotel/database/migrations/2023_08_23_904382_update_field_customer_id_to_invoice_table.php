<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_invoices', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->index()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ht_invoices', function (Blueprint $table) {
            $table->foreignId('customer_id')->change();
        });
    }
};
