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
        $conversionArray = [
            [
            'currency_to_convert' => '1',
            'currency_converted' => '2',
            'pair_reference' => 'u839di63y718xc61',
            'conversion_rate' => '1,5'
            ],
            [
            'currency_to_convert' => '2',
            'currency_converted' => '1',
            'pair_reference' => 'u839di63y718xc61',
            'conversion_rate' => '0,67'
            ],
            [
            'currency_to_convert' => '3',
            'currency_converted' => '4',
            'pair_reference' => 'r177st63m551tq37',
            'conversion_rate' => '3,6'
            ],
            [
            'currency_to_convert' => '4',
            'currency_converted' => '3',
            'pair_reference' => 'r177st63m551tq37',
            'conversion_rate' => '0,28'
            ],
            [
            'currency_to_convert' => '6',
            'currency_converted' => '7',
            'pair_reference' => 'l437yd87m865gq36',
            'conversion_rate' => '4'
            ],
            [
            'currency_to_convert' => '7',
            'currency_converted' => '6',
            'pair_reference' => 'l437yd87m865gq36',
            'conversion_rate' => '0,25'
            ],
        ];

        foreach($conversionArray as $one){
            return [
                'currency_to_convert' => $one['currency_to_convert'],
                'currency_converted' => $one['currency_to_convert'],
                'pair_reference' => $one['currency_to_convert'],
                'conversion_rate' => $one['currency_to_convert'],
            ];
        }
    }
}
