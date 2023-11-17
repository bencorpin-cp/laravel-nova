<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("stock_id");
            $table->unsignedBigInteger("sale_id");
            $table->integer("quantity");
            $table->dateTime("sold_at");
            $table->timestamps();

            $table->foreign("stock_id")
                ->references("id")
                ->on("stocks");

            $table->foreign("sale_id")
                ->references("id")
                ->on("sales");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_stock');
    }
};
