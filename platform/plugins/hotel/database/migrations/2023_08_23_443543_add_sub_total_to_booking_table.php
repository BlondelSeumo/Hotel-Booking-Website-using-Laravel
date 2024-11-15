<?php

use Botble\Hotel\Models\Booking;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('ht_bookings', function (Blueprint $table) {
            $table->unsignedDecimal('sub_total', 15)->after('amount');
        });

        $bookings = Booking::query()->get();

        $bookings->each(function ($booking) {
            $booking->update(['sub_total' => $booking->amount]);
        });
    }

    public function down(): void
    {
        Schema::table('ht_bookings', function (Blueprint $table) {
            $table->dropColumn('sub_total');
        });
    }
};
