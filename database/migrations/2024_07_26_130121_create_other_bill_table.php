<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('other_bill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bill');
            $table->foreign('id_bill')->references('id')->on('bill')->onDelete('cascade');
            $table->unsignedBigInteger('id_clp');
            $table->foreign('id_clp')->references('id')->on('color_pro')->onDelete('cascade');
            $table->string('name_pro');
            $table->string('color_product');
            $table->double('price_pro');
            $table->integer('quantity_pro');
            $table->integer('quantity_cart');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_bill');
    }
};
