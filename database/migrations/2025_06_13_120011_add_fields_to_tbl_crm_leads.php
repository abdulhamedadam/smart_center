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
        Schema::table('tbl_crm_leads', function (Blueprint $table) {
            // Modify existing columns
        
            $table->integer('source')->nullable()->change();
            
            // Add new columns
            $table->string('first_contact_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_crm_leads', function (Blueprint $table) {
            // Revert status and source columns
        
            $table->string('source')->nullable()->change();
            
            // Drop new columns
            $table->dropColumn('first_contact_date');
        });
    }
};
