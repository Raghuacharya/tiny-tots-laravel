<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'aadhaar_number',
        'pan_number',
        'email',
        'phone_number',
        'date_of_birth',
        'gender',
        'address',
        'qualification',
        'specialization',
        'date_joined',
        'status',
        'profile_photo',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_joined' => 'date',
    ];


    // Relationship with Section (one teacher can be assigned to many sections, if needed)
    public function sections()
    {
        return $this->hasMany(Section::class, 'teacher');
    }

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
