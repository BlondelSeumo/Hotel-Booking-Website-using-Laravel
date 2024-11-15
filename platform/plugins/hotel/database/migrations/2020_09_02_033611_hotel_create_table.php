<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('ht_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->string('symbol', 10);
            $table->tinyInteger('is_prefix_symbol')->unsigned()->default(0);
            $table->tinyInteger('decimals')->unsigned()->default(0);
            $table->integer('order')->default(0)->unsigned();
            $table->tinyInteger('is_default')->default(0);
            $table->double('exchange_rate')->default(1);
            $table->timestamps();
        });

        Schema::create('ht_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->text('images')->nullable();
            $table->decimal('price', 15, 0)->nullable()->unsigned();
            $table->foreignId('currency_id')->nullable();
            $table->integer('number_of_rooms')->unsigned()->default(0)->nullable();
            $table->integer('number_of_beds')->unsigned()->default(0)->nullable();
            $table->integer('size')->unsigned()->default(0)->nullable();
            $table->integer('max_adults')->nullable()->default(0);
            $table->integer('max_children')->nullable()->default(0);
            $table->foreignId('room_category_id')->nullable();
            $table->foreignId('tax_id')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('icon', 120)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_rooms_amenities', function (Blueprint $table) {
            $table->foreignId('amenity_id')->index();
            $table->foreignId('room_id')->index();
            $table->timestamps();
            $table->primary(['amenity_id', 'room_id'], 'rooms_amenities_primary');
        });

        Schema::create('ht_foods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description')->nullable();
            $table->decimal('price', 15, 0)->nullable()->unsigned();
            $table->foreignId('currency_id')->nullable();
            $table->foreignId('food_type_id');
            $table->string('image')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_food_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('icon', 120)->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_bookings', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15);
            $table->decimal('tax_amount', 15);
            $table->foreignId('currency_id')->nullable();
            $table->text('requests')->nullable();
            $table->string('arrival_time', 120)->nullable();
            $table->foreignId('payment_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->string('transaction_id', 32)->nullable();
            $table->string('status', 120)->default('pending');
            $table->timestamps();
        });

        Schema::create('ht_booking_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country', 120)->nullable();
            $table->string('state', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('address')->nullable();
            $table->foreignId('booking_id');
            $table->timestamps();
        });

        Schema::create('ht_booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('room_id')->nullable();
            $table->decimal('price', 15);
            $table->foreignId('currency_id')->nullable();
            $table->integer('number_of_rooms')->default(1);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        Schema::create('ht_booking_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('service_id');
        });

        Schema::create('ht_room_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->decimal('price', 15)->nullable();
            $table->tinyInteger('max_guests')->nullable();
            $table->tinyInteger('active')->default(0)->nullable();
            $table->text('note_to_customer')->nullable();
            $table->text('note_to_admin')->nullable();
            $table->smallInteger('number_of_rooms')->nullable();
            $table->timestamps();
        });

        Schema::create('ht_customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 25)->nullable();
            $table->timestamps();
        });

        Schema::create('ht_room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_features', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description')->nullable();
            $table->string('icon', 120)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->decimal('price', 15, 0)->nullable()->unsigned();
            $table->foreignId('currency_id')->nullable();
            $table->string('image')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('distance')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('ht_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->float('percentage', 8, 6)->nullable();
            $table->integer('priority')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ht_currencies');
        Schema::dropIfExists('ht_room_categories');
        Schema::dropIfExists('ht_rooms');
        Schema::dropIfExists('ht_room_dates');
        Schema::dropIfExists('ht_rooms_amenities');
        Schema::dropIfExists('ht_amenities');
        Schema::dropIfExists('ht_food_types');
        Schema::dropIfExists('ht_foods');
        Schema::dropIfExists('ht_bookings');
        Schema::dropIfExists('ht_booking_addresses');
        Schema::dropIfExists('ht_booking_rooms');
        Schema::dropIfExists('ht_booking_services');
        Schema::dropIfExists('ht_customers');
        Schema::dropIfExists('ht_features');
        Schema::dropIfExists('ht_services');
        Schema::dropIfExists('ht_places');
        Schema::dropIfExists('ht_taxes');
    }
};
