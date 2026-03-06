<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManpowerApproval extends Model
{
    use HasFactory;
    protected $primaryKey = 'mrNumApproved';
    protected $fillable = [
        'mrNumApproved',
        'mrNum',
        'college',
        'department',
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
        'vpasignature',
        'directorsignature',
        'dateapproved',
    ];

    public function manpower()
    {
        return $this->belongsTo(Manpower::class, 'mrNum', 'mrNum');
    }
}
