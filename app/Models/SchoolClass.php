<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'academic_year_id',
        'name',
        'code',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
