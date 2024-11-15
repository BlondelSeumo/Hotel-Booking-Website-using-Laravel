<?php

use Botble\Hotel\Models\BookingRoom;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_booking_rooms', function (Blueprint $table) {
            $table->string('room_name', 120)->after('room_id');
            $table->text('room_image')->nullable()->after('room_id');
        });

        $bookingRooms = BookingRoom::query()->with('room')->get();

        foreach ($bookingRooms as $bookingRoom) {
            if (! $bookingRoom->room->id) {
                continue;
            }

            $bookingRoom->room_name = $bookingRoom->room->name;
            $bookingRoom->room_image = $bookingRoom->room->image;
            $bookingRoom->save();
        }
    }

    public function down(): void
    {
        Schema::table('ht_booking_rooms', function (Blueprint $table) {
            $table->dropColumn('room_name');
            $table->dropColumn('room_image');
        });
    }
};
