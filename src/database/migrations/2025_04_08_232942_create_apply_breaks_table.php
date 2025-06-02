<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_breaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apply_clock_id')->constrained()->cascadeOnDelete();
            $table->foreignId('break_time_id')->constrained()->cascadeOnDelete();
            $table->datetime('break_in');
            $table->dateTime('break_out')->nullable();
            $table->string('correction_check')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_breaks');
    }
}
