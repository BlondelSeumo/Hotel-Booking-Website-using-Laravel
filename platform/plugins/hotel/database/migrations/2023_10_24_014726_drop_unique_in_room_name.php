<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        try {
            Schema::table('ht_rooms', function (Blueprint $table) {
                $table->dropUnique('ht_rooms_name_unique');
                $table->string('name', 120)->change();
            });
        } catch (Throwable) {
        }
    }

    public function down(): void
    {
        try {
            Schema::table('ht_rooms', function (Blueprint $table) {
                $table->string('name', 120)->unique()->change();
            });
        } catch (Throwable) {
        }
    }
};
