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
        Schema::create('sv_teams', function (Blueprint $table) {
            $table->bigIncrements('tid');
            $table->string('name');
            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id')->references('cid')->on('sv_clubs')->onDelete('cascade');
            $table->unsignedBigInteger('weapon_id');
            $table->foreign('weapon_id')->references('wid')->on('sv_weapons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_teams');
    }
};
