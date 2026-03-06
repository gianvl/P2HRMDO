<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection8 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section8s';
    protected $primaryKey = 'grand_total_id';
    protected $fillable = [
        'grand_total_id',
        'forecast_num_id',
        'grandt1st',
        'grand2nd',
        'forecastgrandtotal'
    ];
    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
}
