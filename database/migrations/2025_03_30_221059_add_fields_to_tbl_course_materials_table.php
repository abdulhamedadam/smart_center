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
        Schema::table('tbl_course_materials', function (Blueprint $table) {
            $table->integer('from_id')->nullable();
            $table->enum('type',['documents','videos','assignments'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_course_materials', function (Blueprint $table) {
          $table->dropColumn(['from_id','type']);
        });
    }
};
