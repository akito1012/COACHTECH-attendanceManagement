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
        Schema::create('applyBreaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('break_times_id')->constrained()->cascadeOnDelete();
            $table->datetime('break_in');
            $table->dateTime('break_out')->nullable();
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
        Schema::dropIfExists('applyBreaks');
    }
}
