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
        Schema::create('sv_fianl_results_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Rid');
            $table->foreign('Rid')->references('Rid')->on('sv_initial_results')->onDelete('cascade');

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('mid')->on('sv_members')->onDelete('cascade');

            $table->integer('goal')->default(0);

            // Scores R1 - R10
            for ($i = 1; $i <= 10; $i++) {
                $table->decimal("R$i", 8, 2)->default(0);
            }

            $table->decimal('total', 10, 2)->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_fianl_results_players');
    }
};
