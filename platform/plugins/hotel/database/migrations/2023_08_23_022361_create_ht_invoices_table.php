<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('ht_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('payment_id')->nullable()->index();
            $table->morphs('reference');
            $table->string('code')->unique();
            $table->unsignedDecimal('sub_total', 15);
            $table->unsignedDecimal('tax_amount', 15)->default(0);
            $table->unsignedDecimal('discount_amount', 15)->default(0);
            $table->unsignedDecimal('amount', 15);
            $table->string('status')->index()->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ht_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id');
            $table->string('name');
            $table->string('description', 400)->nullable();
            $table->unsignedInteger('qty');
            $table->unsignedDecimal('sub_total', 15);
            $table->unsignedDecimal('tax_amount', 15)->default(0);
            $table->unsignedDecimal('discount_amount', 15)->default(0);
            $table->unsignedDecimal('amount', 15);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ht_invoices');
        Schema::dropIfExists('ht_invoice_items');
    }
};
