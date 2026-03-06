<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'column',
        'order',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getByColumn($column)
    {
        return self::where('column', $column)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)->firstOrFail();
    }
}

