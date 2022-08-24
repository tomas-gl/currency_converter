<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPairs extends Model
{
    use HasFactory;

    protected $fillable = [
		'first_currency_id',
		'second_currency_id',
		'conversion_rate',
	];
}
