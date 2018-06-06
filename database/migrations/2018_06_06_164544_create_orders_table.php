<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->default(0)->unsigned();
            $table->integer('goods_id')->default(0)->unsigned();
            $table->integer('num_total')->default(0)->unsigned();
            $table->decimal('price_total')->default(0);
            $table->decimal('price_discount')->default(0);
            $table->integer('time_confirm')->default(0);
            $table->integer('time_pay')->default(0);
            $table->integer('time_over')->default(0);
            $table->integer('time_cancel')->default(0);
            $table->mediumText('goods_info');
            $table->smallInteger('status')->default(0);
            $table->string('ip')->default('');
            $table->integer('uid')->default(0)->unsigned();
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
        Schema::dropIfExists('orders');
    }
}
