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
        Schema::table('tbl_course_payment_transactions', function (Blueprint $table) {
            $table->enum('transaction_type',['initial_payment','installment'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_course_payment_transactions', function (Blueprint $table) {
            $table->dropColumn(['transaction_type']);
        });
    }
};
