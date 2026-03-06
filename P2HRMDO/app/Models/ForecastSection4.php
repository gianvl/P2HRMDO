<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection4 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section4s';
    protected $primaryKey = 'additional_fac_id';
    protected $fillable = [
        'additional_fac_id',
        'forecast_num_id',
        'numaddfacmember',
        'jspermfull',
        'jspermpart',
        'jscontracfull',
        'jscontracpart'
    ];

    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
}
