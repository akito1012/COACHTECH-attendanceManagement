<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyClocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clock_id')->constrained()->cascadeOnDelete();
            $table->datetime('clock_in');
            $table->dateTime('clock_out')->nullable();
            $table->string('correction_check');
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
        Schema::dropIfExists('applyClocks');
    }
}
