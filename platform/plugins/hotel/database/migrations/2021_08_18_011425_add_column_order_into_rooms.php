<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_rooms', function (Blueprint $table) {
            $table->integer('order')->unsigned()->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('ht_rooms', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
