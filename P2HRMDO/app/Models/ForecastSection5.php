<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection5 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section5s';
    protected $primaryKey = 'jobspec_id';
    protected $fillable = [
        'jobspec_id',
        'forecast_num_id',
        'jsbachelor',
        'jsmasters',
        'jsalliedprog',
        'yrsofteachexp',
        'technicalskills',
        'interpersonalskills'
    ];
    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
}
