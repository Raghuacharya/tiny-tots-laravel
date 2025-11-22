<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active'
    ];

    public static function active()
    {
        return self::where('is_active', true)->first();
    }

    public static function activeId()
    {
        return optional(self::active())->id;
    }
}
