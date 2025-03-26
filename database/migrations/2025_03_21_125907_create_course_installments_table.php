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
        Schema::create('tbl_course_installments', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable()->unique();
            $table->integer('student_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->decimal('total_amount',10,2)->nullable();
            $table->decimal('installment_amount',10,2)->nullable();
            $table->string('due_date')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_installments');
    }
};
