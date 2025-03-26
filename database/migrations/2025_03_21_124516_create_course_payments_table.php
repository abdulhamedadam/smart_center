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
        Schema::create('tbl_course_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable()->unique();
            $table->integer('student_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->tinyInteger('payment_method')->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_payments');
    }
};
