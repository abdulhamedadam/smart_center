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
        Schema::table('tbl_instructors', function (Blueprint $table) {
            $table->integer('gender')->nullable()->after('phone');
            $table->string('date_of_birth')->nullable()->after('gender');
            $table->string('specialization')->nullable()->after('date_of_birth');
            $table->integer('status')->default(1)->after('specialization');
            $table->string('hire_date')->nullable()->after('status');
            $table->text('administrative_notes')->nullable()->after('hire_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_instructors', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'date_of_birth',
                'specialization',
                'status',
                'hire_date',
                'administrative_notes'
            ]);
        });
    }
};
