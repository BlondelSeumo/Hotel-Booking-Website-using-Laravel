<?php

use Botble\Hotel\Facades\HotelHelper;
use Botble\Hotel\Models\Booking;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ec_orders', 'code')) {
            Schema::table('ht_bookings', function (Blueprint $table) {
                $table->string('booking_number')->after('id')->unique()->nullable();
            });
        }

        try {
            foreach (Booking::query()->get() as $booking) {
                $booking->booking_number = HotelHelper::getBookingNumber($booking->id);
                $booking->save();
            }
        } catch (Throwable) {
            // do nothing
        }
    }

    public function down(): void
    {
        Schema::table('ht_bookings', function (Blueprint $table) {
            $table->dropColumn('booking_number');
        });
    }
};
