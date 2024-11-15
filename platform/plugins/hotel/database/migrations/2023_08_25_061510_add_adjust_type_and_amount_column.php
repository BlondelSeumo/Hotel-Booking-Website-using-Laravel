<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_room_dates', function (Blueprint $table) {
            $table->renameColumn('price', 'value');
        });

        Schema::table('ht_room_dates', function (Blueprint $table) {
            $table->string('value_type', 60)->default('fixed')->after('value');
        });
    }

    public function down(): void
    {
        Schema::table('ht_room_dates', function (Blueprint $table) {
            $table->dropColumn('value_type');
        });

        Schema::table('ht_room_dates', function (Blueprint $table) {
            $table->renameColumn('value', 'price');
        });
    }
};
