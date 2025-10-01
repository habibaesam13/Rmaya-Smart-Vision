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
        Schema::create('sv_initial_results', function (Blueprint $table) {
            $table->bigIncrements('Rid');
            $table->date('date')->useCurrent();
            $table->unsignedBigInteger('weapon_id');
            $table->foreign('weapon_id')->references('wid')->on('sv_weapons')->onDelete("cascade");
            $table->integer('details');
            $table->string('attached_file')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_initial_results');
    }
};
