<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $conversionArray = [
        //     [
        //     'currency_to_convert_id' => 1,
        //     'currency_converted_id' => 2,
        //     'pair_reference' => 'u839di63y718xc61',
        //     'conversion_rate' => '1,5'
        //     ],
        //     [
        //     'currency_to_convert_id' => 2,
        //     'currency_converted_id' => 1,
        //     'pair_reference' => 'u839di63y718xc61',
        //     'conversion_rate' => '0,67'
        //     ],
        //     [
        //     'currency_to_convert_id' => 3,
        //     'currency_converted_id' => 4,
        //     'pair_reference' => 'r177st63m551tq37',
        //     'conversion_rate' => '3,6'
        //     ],
        //     [
        //     'currency_to_convert_id' => 4,
        //     'currency_converted_id' => 3,
        //     'pair_reference' => 'r177st63m551tq37',
        //     'conversion_rate' => '0,28'
        //     ],
        //     [
        //     'currency_to_convert_id' => 6,
        //     'currency_converted_id' => 7,
        //     'pair_reference' => 'l437yd87m865gq36',
        //     'conversion_rate' => '4'
        //     ],
        //     [
        //     'currency_to_convert_id' => 7,
        //     'currency_converted_id' => 6,
        //     'pair_reference' => 'l437yd87m865gq36',
        //     'conversion_rate' => '0,25'
        //     ],
        // ];

        // foreach($conversionArray as $conversions){
        //     foreach($conversions as $one){
        //         return [
        //             'currency_to_convert_id' => $one->currency_to_convert_id,
        //             'currency_converted_id' => $one->currency_converted_id,
        //             'pair_reference' => $one->pair_reference,
        //             'conversion_rate' => $one->conversion_rate,
        //         ];
        //     }
        // }
    }
}
