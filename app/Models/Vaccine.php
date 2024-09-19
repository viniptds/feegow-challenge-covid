<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    const MAX_DOSE_COUNT = 3;
    use HasFactory;
    protected $fillable = ['name', 'batch', 'due_date'];

    public function getDueDateAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }
    
    public function getCreatedAtAttribute($value) {
        return date('d/m/Y H:i:s', strtotime($value));
    }
}
