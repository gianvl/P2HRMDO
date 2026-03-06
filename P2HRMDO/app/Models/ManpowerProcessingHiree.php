<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManpowerProcessingHiree extends Model
{
    protected $table = 'manpower_processing_hiree';
    protected $primaryKey = 'mrNumHiree';
    protected $fillable = [
        'mrNumHiree',
        'mrNumProcessing',
        'hireeName',
        'hireeDate',
        'hireeRate'
    ];

    public function manpowerProcessing()
    {
        return $this->belongsTo(ManpowerProcessing::class, 'mrNumProcessing', 'mrNumProcessing');
    }
}
