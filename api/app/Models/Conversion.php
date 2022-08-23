<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
		'currency_to_convert_id',
		'currency_converted_id',
		'pair_reference',
		'conversion_rate',
	];
}
