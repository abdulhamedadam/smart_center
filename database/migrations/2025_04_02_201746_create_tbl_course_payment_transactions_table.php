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
        Schema::create('tbl_course_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('course_payment_id')->nullable();
            $table->integer('installment_id')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_payment_transactions');
    }
};
