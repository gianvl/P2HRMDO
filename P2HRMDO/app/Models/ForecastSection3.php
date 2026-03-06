<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection3 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section3s';
    protected $primaryKey = 'freplacement_id';
    protected $fillable = [
        'freplacement_id',
        'forecast_num_id',
        'namefacreplace',
        'reasonreplace',
        'reasonforhiring'
    ];

    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }

    //public $incrementing = false; // Set to false if the primary key is not auto-incrementing

    //protected $keyType = 'string'; // Set the primary key data type if it's not an integer

}
