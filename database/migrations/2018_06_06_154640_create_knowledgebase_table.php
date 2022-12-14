<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateKnowledgebaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledgebase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group')->nullable();
            $table->mediumText('subject')->nullable();
            $table->mediumText('slug')->nullable();
            $table->longText('description')->nullable();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->integer('views')->default(0);
            $table->tinyInteger('allow_comments')->default(1);
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
        Schema::dropIfExists('knowledgebase');
    }
}
