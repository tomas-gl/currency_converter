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
            $table->foreign('currency_converted_id')->references('id')->on('currencies')->onDelete('set null');
            $table->string('pair_reference_number', 13)->nullable();
            $table->decimal('conversion_rate', $precision = 8, $scale = 2)->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('conversions')->insert(
            array(
                [
                'currency_to_convert_id' => 1,
                'currency_converted_id' => 2,
                'pair_reference_number' => '1661269611966',
                'conversion_rate' => '1.5'
                ],
                [
                'currency_to_convert_id' => 2,
                'currency_converted_id' => 1,
                'pair_reference_number' => '1661269611966',
                'conversion_rate' => '0.67'
                ],
                [
                'currency_to_convert_id' => 3,
                'currency_converted_id' => 4,
                'pair_reference_number' => '1661269616095',
                'conversion_rate' => '3.6'
                ],
                [
                'currency_to_convert_id' => 4,
                'currency_converted_id' => 3,
                'pair_reference_number' => '1661269616095',
                'conversion_rate' => '0.28'
                ],
                [
                'currency_to_convert_id' => 6,
                'currency_converted_id' => 7,
                'pair_reference_number' => '1661269619796',
                'conversion_rate' => '4'
                ],
                [
                'currency_to_convert_id' => 7,
                'currency_converted_id' => 6,
                'pair_reference_number' => '1661269619796',
                'conversion_rate' => '0.25'
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
