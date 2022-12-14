<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('company')->nullable();
            $table->string('job_title')->default('N/A');
            $table->string('city', 40)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('address', 64)->default('-');
            $table->string('phone', 32)->default('-');
            $table->string('mobile', 32)->nullable();
            $table->string('skype', 100)->nullable();
            $table->mediumText('avatar')->nullable();
            $table->tinyInteger('use_gravatar')->default('0');
            $table->decimal('hourly_rate', 10, 2)->default(0.00);
            $table->string('state', 32)->nullable();
            $table->string('zip_code', 32)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('twitter', 64)->nullable();
            $table->string('signature')->nullable();
            $table->text('email_signature')->nullable();
            $table->string('channels')->default('["slack","mail","database"]');
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
        Schema::dropIfExists('profiles');
    }
}
