<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ht_bookings', function (Blueprint $table) {
            $table->integer('number_of_children')->default(0)->after('number_of_guests');
        });
    }

    public function down(): void
    {
        Schema::table('ht_bookings', function (Blueprint $table) {
            $table->dropColumn('number_of_children');
        });
    }
};
