<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('ht_rooms_translations');
        Schema::dropIfExists('ht_food_types_translations');
        Schema::dropIfExists('ht_amenities_translations');
        Schema::dropIfExists('ht_features_translations');
        Schema::dropIfExists('ht_foods_translations');
        Schema::dropIfExists('ht_places_translations');
        Schema::dropIfExists('ht_room_categories_translations');
        Schema::dropIfExists('ht_services_translations');

        Schema::create('ht_rooms_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_rooms_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->primary(['lang_code', 'ht_rooms_id'], 'ht_rooms_translations_primary');
        });

        Schema::create('ht_amenities_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_amenities_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->primary(['lang_code', 'ht_amenities_id'], 'ht_amenities_translations_primary');
        });

        Schema::create('ht_features_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_features_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->primary(['lang_code', 'ht_features_id'], 'ht_features_translations_primary');
        });

        Schema::create('ht_foods_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_foods_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->primary(['lang_code', 'ht_foods_id'], 'ht_foods_translations_primary');
        });

        Schema::create('ht_food_types_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_food_types_id');
            $table->string('name')->nullable();

            $table->primary(['lang_code', 'ht_food_types_id'], 'ht_food_types_translations_primary');
        });

        Schema::create('ht_places_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_places_id');
            $table->string('name')->nullable();
            $table->text('distance')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->primary(['lang_code', 'ht_places_id'], 'ht_places_translations_primary');
        });

        Schema::create('ht_room_categories_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_room_categories_id');
            $table->string('name')->nullable();

            $table->primary(['lang_code', 'ht_room_categories_id'], 'ht_room_categories_translations_primary');
        });

        Schema::create('ht_services_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('ht_services_id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->primary(['lang_code', 'ht_services_id'], 'ht_services_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ht_rooms_translations');
        Schema::dropIfExists('ht_amenities_translations');
        Schema::dropIfExists('ht_features_translations');
        Schema::dropIfExists('ht_foods_translations');
        Schema::dropIfExists('ht_food_types_translations');
        Schema::dropIfExists('ht_places_translations');
        Schema::dropIfExists('ht_room_categories_translations');
        Schema::dropIfExists('ht_services_translations');
    }
};
