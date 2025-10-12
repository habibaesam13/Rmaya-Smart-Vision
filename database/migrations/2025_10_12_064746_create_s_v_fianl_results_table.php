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
        Schema::create('sv_fianl_results', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('weapon_id');
            $table->foreign('weapon_id')->references('wid')->on('sv_weapons')->onDelete("cascade");
            $table->text('details')->nullable();
             $table->text('file')->nullable();
            $table->boolean('confirmed' )->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_fianl_results');
    }
};
