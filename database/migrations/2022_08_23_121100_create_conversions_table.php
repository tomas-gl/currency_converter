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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_to_convert_id')->nullable();
            $table->foreign('currency_to_convert_id')->references('id')->on('currencies')->onDelete('set null');
            $table->foreignId('currency_converted_id')->nullable();
            $table->foreign('currency_converted_id')->references('id')->on('currencies ')->onDelete('set null');
            $table->string('pair_reference', 16)->nullable();
            $table->decimal('conversion_rate', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('conversions');
    }
};
