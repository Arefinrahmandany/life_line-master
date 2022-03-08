<?php

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
            $table->id();
            $table->string('name');
            $table->integer('type_id')->default(0);
            $table->string('userid')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo_uri')->nullable();
            $table->string('verify_code')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_two_factor_auth')->default(0);
            $table->timestamp('last_active_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidphp artisan migrate
     **/
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
