<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->tinyInteger('status')->default(0); // 0: pending, 1: processing, 2: completed, 3: cancelled
            $table->tinyInteger('payment_status')->default(0); // 0: pending, 1: paid, 2: failed
            $table->string('payment_method')->nullable();
            $table->text('shipping_address');
            $table->string('shipping_phone');
            $table->text('notes')->nullable();
            $table->json('order_details')->nullable(); // لتخزين تفاصيل المنتجات في الطلب
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders__tabel');
    }
};
