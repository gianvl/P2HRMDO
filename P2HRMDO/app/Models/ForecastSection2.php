<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection2 extends Model
{
    protected $table = 'forecast_section2s';
    protected $primaryKey = 'emc_id';
    protected $fillable = [
        'emc_id',
        'forecast_num_id',
        'fulltimeperm',
        'parttimeperm',
        'fulltimecontrac',
        'parttimecontrac'
    ];

    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
    
    //public $incrementing = false; // Set to false if the primary key is not auto-incrementing

    //protected $keyType = 'string'; // Set the primary key data type if it's not an integer

}