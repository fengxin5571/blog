<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('active_id')->default(0)->unsigned();
            $table->string('title',255)->default('');
            $table->text('description');
            $table->string('img')->default('');
            $table->decimal('price_normal')->default(0);
            $table->decimal("price_discount")->default(0);
            $table->integer('num_total')->default(0)->unsigned();
            $table->smallInteger('status')->default(0)->unsigned();
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
        Schema::dropIfExists('goods');
    }
}
