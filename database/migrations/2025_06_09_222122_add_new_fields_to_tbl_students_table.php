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
        Schema::table('tbl_students', function (Blueprint $table) {
            $table->integer('city_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('educational_institution')->nullable();
            $table->text('admin_notes')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_students', function (Blueprint $table) {
    
            $table->dropColumn([
                'city_id',
                'region_id',
                'educational_qualification',
                'field_of_study',
                'admin_notes'
   
            ]);
        });
    }
};
