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
        Schema::create('sv_members', function (Blueprint $table) {
            $table->bigIncrements('mid');
            $table->enum('reg_type', ['personal', 'group']);

            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')
                ->references('tid')
                ->on('sv_teams')
                ->onDelete('cascade');

            $table->string('name');

            $table->string('ID', 15)->unique(); 

            $table->date('Id_expire_date');
            $table->date('dob');

            $table->unsignedBigInteger('nat')->default(222);
            $table->foreign('nat')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->enum('gender', ['male', 'female']);

            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id')
                ->references('cid')
                ->on('sv_clubs')
                ->onDelete('cascade');

            $table->unsignedBigInteger('weapon_id');
            $table->foreign('weapon_id')
                ->references('wid')
                ->on('sv_weapons')
                ->onDelete('cascade');
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();

            $table->string('front_id_pic');
            $table->string('back_id_pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv_members');
    }
};
