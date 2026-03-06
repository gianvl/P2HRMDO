<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection1 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section1s';
    protected $primaryKey = 'forecast_num_id';
    protected $fillable = [
        'forecast_num_id',
        'college',
        'department',
        'ay',
        'semester',
        'chairsignature',
        'deansignature',
        'approval_status', 
    ];

    public function forecastSection2s()
    {
        return $this->hasMany(ForecastSection2::class, 'forecast_num_id', 'forecast_num_id');
    }

    public function forecastSection3s()
    {
        return $this->hasMany(ForecastSection3::class, 'forecast_num_id', 'forecast_num_id');
    }
    public function forecastSection4s()
    {
        return $this->hasMany(ForecastSection4::class, 'forecast_num_id', 'forecast_num_id');
    }
    public function forecastSection5s()
    {
        return $this->hasMany(ForecastSection5::class, 'forecast_num_id', 'forecast_num_id');
    }
    public function forecastSection6s()
    {
        return $this->hasMany(ForecastSection6::class, 'forecast_num_id', 'forecast_num_id');
    }
    public function forecastSection7s()
    {
        return $this->hasMany(ForecastSection7::class, 'forecast_num_id', 'forecast_num_id');
    }
    public function forecastSection8s()
    {
        return $this->hasMany(ForecastSection8::class, 'forecast_num_id', 'forecast_num_id');
    }

    //public $incrementing = false; // Set to false if the primary key is not auto-incrementing

    //protected $keyType = 'string'; // Set the primary key data type if it's not an integer

}
