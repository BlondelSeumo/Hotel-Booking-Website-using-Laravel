<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_customers', function (Blueprint $table) {
            $table->string('country', 120)->nullable()->after('phone');
            $table->string('state', 120)->nullable()->after('phone');
            $table->string('city', 120)->nullable()->after('phone');
            $table->string('zip', 10)->nullable()->after('phone');
            $table->string('address')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('ht_customers', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('state');
            $table->dropColumn('city');
            $table->dropColumn('zip');
            $table->dropColumn('address');
        });
    }
};
