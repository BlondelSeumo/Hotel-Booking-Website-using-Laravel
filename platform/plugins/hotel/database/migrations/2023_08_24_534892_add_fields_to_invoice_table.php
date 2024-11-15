<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_invoices', function (Blueprint $table) {
            $table->string('customer_name')->after('customer_id');
            $table->string('customer_email')->after('customer_name');
            $table->string('customer_phone')->after('customer_email');
            $table->string('customer_address')->after('customer_phone');
        });
    }

    public function down(): void
    {
        Schema::table('ht_invoices', function (Blueprint $table) {
            $table->dropColumn('customer_address');
            $table->dropColumn('customer_phone');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_name');
        });
    }
};
