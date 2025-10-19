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
        Schema::table('sv_clubs_weapons', function (Blueprint $table) {
            $table->unique(['cid','wid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sv_clubs_weapons', function (Blueprint $table) {
             $table->dropUnique('sv_clubs_weapons_cid_wid_unique');
        });
    }
};
