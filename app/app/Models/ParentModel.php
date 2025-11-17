<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'father_name',
        'father_occupation',
        'father_place_of_work',
        'father_office_address',
        'father_email',
        'father_contact_no',
        'father_photo',
        'mother_name',
        'mother_occupation',
        'mother_place_of_work',
        'mother_office_address',
        'mother_email',
        'mother_contact_no',
        'mother_photo',
        'residential_address',
        'residential_contact',
        'guardian_name',
        'guardian_relationship',
        'guardian_contact',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_contact_address',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

    /**
     * Get combined display name for father and mother.
     */
    public function getDisplayNameAttribute(): string
    {
        $father = $this->father_name ?? '';
        $mother = $this->mother_name ?? '';

        // If both are available
        if ($father && $mother) {
            return "{$father} & {$mother}";
        }

        // If only one is available
        return $father ?: ($mother ?: 'N/A');
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class, 'parent_id');
    }
}
