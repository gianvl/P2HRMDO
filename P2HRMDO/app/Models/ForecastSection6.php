<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastSection6 extends Model
{
    use HasFactory;
    protected $table = 'forecast_section6s';
    protected $primaryKey = 'majorsubj_id';
    protected $fillable = [
        'majorsubj_id',
        'forecast_num_id',

        'aydropdown1s',
        'aydropdown2s',
        'forecastSemester',
        
        'studentpop1y1s',
        'studentpop1y2s',
        'Total1y1s2sstudent',

        'numsectopened1y1s',
        'numsectopened1y2s',
        'Total1y1s2ssection',

        'studentpop2y1s',
        'studentpop2y2s',
        'Total2y1s2sstudent',

        'numsectopened2y1s',
        'numsectopened2y2s',
        'Total2y1s2ssection',

        'studentpop3y1s',
        'studentpop3y2s',
        'Total3y1s2sstudent',

        'numsectopened3y1s',
        'numsectopened3y2s',
        'Total3y1s2ssection',

        'studentpop4y1s',
        'studentpop4y2s',
        'Total4y1s2sstudent',

        'numsectopened4y1s',
        'numsectopened4y2s',
        'Total4y1s2ssection',

        'studentpop5y1s',
        'studentpop5y2s',
        'Total5y1s2sstudent',

        'numsectopened5y1s',
        'numsectopened5y2s',
        'Total5y1s2ssection',

        'Total1sstudent',
        'Total2sstudent',
        'TotalStudentForecast',

        'Total1ssection',
        'Total2ssection',
        'TotalSectionForecast',

    ];
    public function forecastSection1()
    {
        return $this->belongsTo(ForecastSection1::class, 'forecast_num_id', 'forecast_num_id');
    }
}
