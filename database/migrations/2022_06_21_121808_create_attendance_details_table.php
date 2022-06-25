<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_details', function (Blueprint $table) {
            $table->foreignId('attendance_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_present')->default(1);
            $table->primary(['attendance_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_details');
    }
};
