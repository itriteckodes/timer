<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreathesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breathes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->nullable();
            $table->time('Start_time');
            $table->time('duration')->nullable();
            $table->integer('hour')->nullable()->default(00);
            $table->integer('min')->nullable()->default(00);
            $table->integer('sec')->nullable()->default(00);
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
        Schema::dropIfExists('breathes');
    }
}
