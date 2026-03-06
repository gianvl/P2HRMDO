<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection7 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section7s';
    protected $primaryKey = 'servsubj_id';
    protected $fillable = [
        'servsubj_id',
        'forecast_num_id',
        'servsubj',
        'ssubj1stnumsectopened',
        'ssubj2ndnumsectopened',
        'Total1s2sForecastServSubject'

    ];
    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
}
