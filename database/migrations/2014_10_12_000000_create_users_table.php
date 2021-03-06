<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->unique();
            $table->string('password');

            $table->string('image_profile');

            $table->date('birthday');
            $table->enum('gender', [User::MALE, User::FEMALE]);

            $table->enum(
                'verified',
                [User::ACCEPTED, User::REJECTED, User::CHECKING]
            )->default(User::CHECKING);
            $table->timestamp('verified_at')->nullable();

            $table->enum('type', [User::ADMIN, User::PATIENT, User::NUTRITIONIST]);

            $table->enum('status', [User::ACTIVE, User::INACTIVE])->default(User::ACTIVE);

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
