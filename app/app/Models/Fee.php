<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'amount',
        'due_date',
        'description',
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'fee_id');
    }
}
