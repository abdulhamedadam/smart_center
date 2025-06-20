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
        Schema::table('tbl_crm_follow_ups', function (Blueprint $table) {
            $table->integer('communication_type')->nullable()->after('result');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_crm_follow_ups', function (Blueprint $table) {
            $table->dropColumn('communication_type');
        });
    }
};
