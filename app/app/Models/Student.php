<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'full_name',
        'date_of_birth',
        'age_years',
        'age_months',
        'gender',
        'place_of_birth',
        'nationality',
        'mother_tongue',
        'blood_group',
        'class_id',
        'section_id',
        'allergies',
        'surgeries',
        'chronic_illness',
        'immunization_complete',
        'medical_notes',
        'parent_id',
        'attended_school_previously',
        'previous_school_name',
        'previous_school_duration',
        'previous_class_attended',
        'child_photo',
        'status',
        'admission_date',
        'birth_certificate',
        'immuization_record',
        'transfer_certificate',
        'progress_report',
        'passport',
        'medical_report',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
        'attended_school_previously' => 'boolean',
    ];

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // public function payments(): HasMany
    // {
    //     return $this->hasMany(Payment::class);
    // }

    // public function receipts(): HasMany
    // {
    //     return $this->hasMany(Receipt::class);
    // }

    // Accessors
    public function getCalculatedAgeAttribute(): string
    {
        if ($this->date_of_birth) {
            $birthDate = Carbon::parse($this->date_of_birth);
            $now = Carbon::now();
            $years = $birthDate->diffInYears($now);
            $months = $birthDate->copy()->addYears($years)->diffInMonths($now);
            return "{$years} years {$months} months";
        }

        return $this->age_years ? "{$this->age_years} years {$this->age_months} months" : 'N/A';
    }

    public function getProfilePhotoAttribute(): string
    {
        if ($this->child_photo && file_exists(public_path('storage/' . $this->child_photo))) {
            return asset('storage/' . $this->child_photo);
        }

        // Default avatar based on gender
        $defaultAvatar = $this->gender === 'female' ? 'girl-avatar.png' : 'boy-avatar.png';
        return asset('images/defaults/' . $defaultAvatar);
    }

    public function getDocumentCompletionPercentageAttribute(): int
    {
        $totalDocuments = 7; // Total number of document fields
        $submittedCount = 0;

        $documentFields = [
            'birth_certificate_submitted',
            'immunization_record_submitted',
            'transfer_certificate_submitted',
            'photos_submitted',
            'progress_report_submitted',
            'passport_submitted',
            'medical_report_submitted',
        ];

        foreach ($documentFields as $field) {
            if ($this->$field) {
                $submittedCount++;
            }
        }

        return round(($submittedCount / $totalDocuments) * 100);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeWithdrawn($query)
    {
        return $query->where('status', 'withdrawn');
    }

    public function scopeGraduated($query)
    {
        return $query->where('status', 'graduated');
    }

    public function scopeWithMedicalConditions($query)
    {
        return $query->where(function($q) {
            $q->whereNotNull('allergies')
              ->orWhereNotNull('surgeries')
              ->orWhereNotNull('chronic_illness');
        });
    }

    public function scopeIncompleteDocuments($query)
    {
        return $query->where(function($q) {
            $q->where('birth_certificate_submitted', false)
              ->orWhere('immunization_record_submitted', false)
              ->orWhere('photos_submitted', false);
        });
    }

    // Helper Methods
    public function hasMedicalConditions(): bool
    {
        return !empty($this->allergies) || !empty($this->surgeries) || !empty($this->chronic_illness);
    }

    public function hasGuardian(): bool
    {
        return !empty($this->guardian_name);
    }

    public function attendedSchoolPreviously(): bool
    {
        return $this->attended_school_previously && !empty($this->previous_school_name);
    }

    public function isDocumentationComplete(): bool
    {
        // Core documents that are always required
        $coreDocuments = [
            'birth_certificate_submitted',
            'immunization_record_submitted',
            'photos_submitted',
        ];

        foreach ($coreDocuments as $document) {
            if (!$this->$document) {
                return false;
            }
        }

        return true;
    }

    // Generate student ID automatically
    public static function generateStudentId(): string
    {
        $lastStudent = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastStudent ? (int) substr($lastStudent->student_id, 3) + 1 : 1;
        return 'LHB' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // LHB001, LHB002, etc.
    }
}
