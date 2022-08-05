<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deptid');
            $table->string('module', 64)->nullable();
            $table->integer('form_id')->nullable();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('uniqid')->unique();
            $table->string('type')->nullable();
            $table->tinyInteger('required')->nullable();
            $table->text('field_options')->nullable();
            $table->string('cid', 32)->nullable();
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
