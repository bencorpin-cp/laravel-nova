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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("stock_id");
            $table->unsignedBigInteger("customer_id");
            $table->string("quantity");
            $table->timestamps();

            $table->foreign("stock_id")
                ->references("id")
                ->on("stocks");

            $table->foreign("customer_id")
                ->references("id")
                ->on("customers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
