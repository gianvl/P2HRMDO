<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'ay',
        'awolna',
        'semester',
        'absences',
        'student',
        'peer',
        'dean',
        'chairperson',
        'empstatus',
        'overallstatus'
    ];
}
