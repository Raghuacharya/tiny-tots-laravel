<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['class_id', 'name', 'teacher'];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
