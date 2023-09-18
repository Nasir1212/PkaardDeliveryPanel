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
        //card_delivery
        Schema::create('card_delivery', function (Blueprint $table) {
            $table->id();
            $table->string('registation_no')->nullable();
            $table->string('card_no')->nullable();
            $table->float('amount')->nullable();
            $table->float('payment')->nullable();
            $table->float('paid')->nullable();
            $table->boolean('packing')->nullable();
            $table->boolean('delivery_complete')->nullable();
            $table->boolean('return_card')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
