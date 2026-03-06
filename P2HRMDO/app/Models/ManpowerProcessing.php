<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManpowerProcessing extends Model
{
    use HasFactory;
    protected $table = 'manpower_processing';
    protected $primaryKey = 'mrNumProcessing';
    protected $fillable = [
        'mrNumProcessing',
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
        'receivedBy',
        'rank',
        'datereceived',
        'datecompleted',
    ];

    public function manpower()
    {
        return $this->belongsTo(Manpower::class, 'mrNum', 'mrNum');
    }

    public function manpowerProcessingHiree()
    {
        return $this->hasMany(ManpowerProcessingHiree::class, 'mrNumProcessing', 'mrNumProcessing');
    }
}
