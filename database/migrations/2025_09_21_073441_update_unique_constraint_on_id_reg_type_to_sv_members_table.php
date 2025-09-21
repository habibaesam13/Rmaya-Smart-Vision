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
            $table->unique(['ID', 'reg_type', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sv_members', function (Blueprint $table) {
   
            $table->dropUnique(['ID', 'reg_type', 'team_id']);

        });
    }
};
