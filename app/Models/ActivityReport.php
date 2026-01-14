<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_date',
        'activity_type',
        'duration',
        'description',
        'performance_rating',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'duration' => 'integer',
        'performance_rating' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
