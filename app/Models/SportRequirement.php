<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportRequirement extends Model
{
    protected $fillable = [
        'coach_id',
        'sport_available_id',
        'min_age',
        'max_age',
        'required_gender',
        'min_height',
        'max_height',
        'min_weight',
        'max_weight',
        'min_experience_years',
        'required_level',
        'required_positions',
        'medical_restrictions',
        'is_active',
    ];

    protected $casts = [
        'required_positions' => 'array',
        'medical_restrictions' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function sportAvailable()
    {
        return $this->belongsTo(SportAvailable::class, 'sport_available_id');
    }
}
