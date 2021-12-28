<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->unique()->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('nutritionist_id');
            $table->foreign('nutritionist_id')->references('id')->on('users');

            $table->string('phone_number');
            $table->mediumText('address');
            $table->string('scholarship');
            $table->string('occupation');
            $table->longText('description');

            $table->double('height');
            $table->double('weight');

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
        Schema::dropIfExists('patients');
    }
}
