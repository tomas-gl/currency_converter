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
        Schema::create('currency_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('first_currency_id')->nullable();
            $table->foreign('first_currency_id')->references('id')->on('currencies')->onDelete('set null');
            $table->foreignId('second_currency_id')->nullable();
            $table->foreign('second_currency_id')->references('id')->on('currencies')->onDelete('set null');
            $table->decimal('conversion_rate', $precision = 8, $scale = 2)->nullable();
            $table->integer('conversion_request')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('currency_pairs')->insert(
            array(
                [
                'first_currency_id' => 1,
                'second_currency_id' => 2,
                'conversion_rate' => '1.5',
                'conversion_request' => 0
                ],
                [
                'first_currency_id' => 3,
                'second_currency_id' => 4,
                'conversion_rate' => '3.6',
                'conversion_request' => 0
                ],
                [
                'first_currency_id' => 6,
                'second_currency_id' => 7,
                'conversion_rate' => '4',
                'conversion_request' => 0
                ],
            )
        );
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
