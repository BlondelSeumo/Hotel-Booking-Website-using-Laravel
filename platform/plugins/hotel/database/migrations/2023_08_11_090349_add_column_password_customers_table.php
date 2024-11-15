<?php

use Botble\Hotel\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::table('ht_customers', function (Blueprint $table) {
            $table->string('password')->nullable()->after('email');
            $table->rememberToken();
            $table->dateTime('confirmed_at')->nullable();
        });

        Customer::query()->whereNull('confirmed_at')->update(['confirmed_at' => Carbon::now()]);
    }

    public function down(): void
    {
        Schema::table('ht_customers', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropRememberToken();
            $table->dropColumn('confirmed_at');
        });
    }
};
