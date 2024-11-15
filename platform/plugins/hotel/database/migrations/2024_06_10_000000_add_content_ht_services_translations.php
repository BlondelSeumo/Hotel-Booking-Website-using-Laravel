<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_services_translations', function (Blueprint $table) {
            $table->longText('content')->after('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('ht_services_translations', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }
};
