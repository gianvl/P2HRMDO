<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manpower extends Model
{
    use HasFactory;
    protected $primaryKey = 'mrNum';
    protected $fillable = [
        'mrNum',
        'college',
        'department',
        'ay',
        'semester',
        'num_emp_required',
        'employment_status',
        'position',
        'category',
        'category_textbox',
        'replacement_dropdown',
        'replacement_others_textbox',
        'budget',
        'fileInput',
        'expertise_textbox',
        'regular',
        'probationary',
        'contractual',
        'studassistant',
        'total',
        'approval_status',
        'chairsignature',
        'deansignature',
        'daterequested',
    ];

    public function approval()
    {
        return $this->hasOne(ManpowerApproval::class);
    }

    public function processing()
    {
        return $this->hasOne(ManpowerProcessing::class);
    }

}
