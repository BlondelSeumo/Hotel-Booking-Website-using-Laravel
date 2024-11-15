<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_services', function (Blueprint $table) {
            $table->string('price_type')->default('once')->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('ht_services', function (Blueprint $table) {
            $table->dropColumn('price_type');
        });
    }
};
