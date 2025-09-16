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
        Schema::table('sv_members', function (Blueprint $table) {
            // Drop the old unique constraint on ID if it exists
            $table->dropUnique('sv_members_id_unique'); 

            // Add composite unique (ID + reg_type)
            $table->unique(['ID', 'reg_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sv_members', function (Blueprint $table) {
             // Remove the composite unique
            $table->dropUnique(['ID', 'reg_type']);

            // Restore single unique on ID
            $table->unique('ID');
        });
    }
};
