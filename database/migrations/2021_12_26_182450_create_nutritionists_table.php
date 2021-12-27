<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritionists', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->unique()->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('phone_number');
            $table->mediumText('address');
            $table->longText('description');

            $table->string('curriculum');
            $table->string('identification_card')->unique();
            $table->json('specializations');

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
        Schema::dropIfExists('nutritionists');
    }
}
