<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'key',
        'value',
        'content',
        'order',
    ];

    /**
     * Get content by section and key
     */
    public static function getContent($section, $key)
    {
        $content = self::where('section', $section)
            ->where('key', $key)
            ->first();
        
        return $content ? $content->value : null;
    }

    /**
     * Get all content for a section
     */
    public static function getSection($section)
    {
        return self::where('section', $section)
            ->orderBy('order')
            ->get()
            ->keyBy('key');
    }

    /**
     * Get all sections
     */
    public static function getAllSections()
    {
        return self::orderBy('section')
            ->orderBy('order')
            ->get()
            ->groupBy('section');
    }
}

