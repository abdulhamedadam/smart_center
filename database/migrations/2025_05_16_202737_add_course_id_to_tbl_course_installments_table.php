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
        Schema::table('tbl_course_installments', function (Blueprint $table) {
            $table->integer('course_id')->nullable();
            $table->integer('student_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_course_installments', function (Blueprint $table) {
            $table->dropColumn(['course_id','student_id']);
        });
    }
};
