<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('ht_room_reviews')) {
            Schema::create('ht_room_reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('customer_id');
                $table->integer('room_id');
                $table->tinyInteger('star');
                $table->string('content', 500);
                $table->string('status', 60)->default('approved');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ht_room_reviews');
    }
};
