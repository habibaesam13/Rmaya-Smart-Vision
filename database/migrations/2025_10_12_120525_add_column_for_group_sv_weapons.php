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
        Schema::table('sv_weapons', function (Blueprint $table) {
            $table->enum('reg_type',['personal','group']);
            $table->integer('number_of_members')->max(5)->min(0)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sv_weapons', function (Blueprint $table) {
            
        });
    }
};
