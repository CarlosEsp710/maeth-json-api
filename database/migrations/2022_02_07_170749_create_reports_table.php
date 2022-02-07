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

            $table->longText('clinical_indicators');
            $table->longText('family_background');
            $table->longText('gynecological_history')->nullable();
            $table->longText('life_style');
            $table->longText('daily_routine');
            $table->longText('dietary_indicators');
            $table->longText('food_characteristics');
            $table->longText('consumption_variants');
            $table->longText('usual_diet');

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
