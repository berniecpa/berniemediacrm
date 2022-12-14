<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('tax_rate', 10, 2)->default(0.00);
            $table->decimal('tax_total', 10, 2)->default(0.00);
            $table->decimal('quantity', 10, 2)->default(0.00);
            $table->decimal('unit_cost', 13, 3)->default(0.000);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->decimal('total_cost', 13, 2)->default(0.00);
            $table->string('name')->default('Item Name');
            $table->longText('description')->nullable();
            $table->integer('order')->nullable();
            $table->morphs('itemable');
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
        Schema::dropIfExists('items');
    }
}
