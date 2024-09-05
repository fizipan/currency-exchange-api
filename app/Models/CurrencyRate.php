<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    // Specify the table name if different from the default
    protected $table = 'currency_rates';

    // Define the fillable attributes
    protected $fillable = [
        'currency',
        'rate',
        'date'
    ];
}
