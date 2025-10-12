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
        Schema::create('role_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId("role_id")->nullable()->constrained("roles") ->nullOnDelete()->cascadeOnUpdate();
            $table->string('module_code' );
//            $table->enum('event_period' , ['lunch' , 'dinner' , 'full_day']);
//            $table->enum('status' , ['pending' , 'accepted' , 'completed' , 'postponed' , 'deleted'])->nullable()->default('pending');
//            $table->date('booking_date')->nullable();
//            $table->time('start_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_modules');
    }
};
