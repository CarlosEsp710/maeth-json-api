<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->string('clinical_indicators');
            $table->string('family_background');
            $table->string('gynecological_history')->nullable();
            $table->string('life_style');
            $table->string('daily_routine');
            $table->string('dietary_indicators');
            $table->string('food_characteristics');
            $table->string('consumption_variants');
            $table->string('usual_diet');

            $table->string('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');

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
        Schema::dropIfExists('reports');
    }
}
