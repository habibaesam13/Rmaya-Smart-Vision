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
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('mgid');
            $table->foreign('mgid')->references('mgid')->on('member_groups');
            $table->unsignedBigInteger('reg_club');
            $table->foreign('reg_club')->references('cid')->on('sv_clubs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sv_members', function (Blueprint $table) {
            

        });
    }
};
