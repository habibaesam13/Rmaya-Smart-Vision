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
        Schema::create('sv_clubs_weapons', function (Blueprint $table) {
            $table->bigIncrements("cwid");
            $table->unsignedBigInteger("cid");
            $table->unsignedBigInteger("wid");
            $table->foreign("cid")->references("cid")->on("sv_clubs")->onDelete("cascade");
            $table->foreign("wid")->references("wid")->on("sv_weapons")->onDelete("cascade");
            $table->enum("gender", ["male", "female"]);
            $table->integer("age_from")->min(1)->max(100);
            $table->integer("age_to")->nullable()->min(0)->max(100);
            $table->integer("success_degree")->min(1)->max(100);
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_clubs_weapons');
    }
};
