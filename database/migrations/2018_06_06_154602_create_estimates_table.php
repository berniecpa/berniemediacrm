<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration auto-generated by Sequel Pro Laravel Export
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no', 32)->unique();
            $table->string('title')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('deal_id')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->string('currency', 32)->default('USD');
            $table->decimal('discount', 10, 2)->default(0.00)->nullable();
            $table->text('notes')->nullable();
            $table->decimal('tax', 10, 2)->default(0.00)->nullable();
            $table->decimal('tax2', 10, 2)->default(0.00)->nullable();
            $table->string('status', 100)->default('Pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->tinyInteger('discount_percent')->default(1);
            $table->integer('invoiced_id')->nullable();
            $table->timestamp('invoiced_at')->nullable();
            $table->dateTime('accepted_time')->nullable();
            $table->dateTime('rejected_time')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->decimal('exchange_rate', 10, 5)->default(1.00000);
            $table->tinyInteger('is_visible')->default(0);
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('sub_total', 10, 2)->default(0.00);
            $table->decimal('discounted', 10, 2)->default(0.00);
            $table->decimal('tax1_amount', 10, 2)->default(0.00);
            $table->decimal('tax2_amount', 10, 2)->default(0.00);
            $table->timestamp('reminded_at')->nullable();
            $table->timestamp('archived_at')->nullable();
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
        Schema::dropIfExists('estimates');
    }
}