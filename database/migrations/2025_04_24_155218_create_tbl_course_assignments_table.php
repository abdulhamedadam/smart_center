<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_course_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('total_marks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_assignments');
    }
};
