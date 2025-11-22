<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address',
        'contact_email',
        'contact_phone',
        'website',
        'logo',
    ];

    // Helper: get school details globally
    public static function current()
    {
        // assuming single school for now
        return self::first();
    }
}
