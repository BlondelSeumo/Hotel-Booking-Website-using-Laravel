<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_room_categories', function (Blueprint $table) {
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
        });

        DB::table('ht_room_categories')->where('is_featured', 0)->update(['is_featured' => 1]);
    }

    public function down(): void
    {
        Schema::table('ht_room_categories', function (Blueprint $table) {
            $table->dropColumn(['order', 'is_featured']);
        });
    }
};
