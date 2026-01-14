<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * Safely implode an array with a separator, handling non-array values
     *
     * @param string $separator
     * @param mixed $array
     * @return string
     */
    public static function safeImplode(string $separator, $array): string
    {
        if (is_array($array)) {
            return implode($separator, $array);
        }

        if (is_string($array) && !empty($array)) {
            // If it's a string, return as-is or try to split and rejoin
            return $array;
        }

        return '';
    }

    /**
     * Ensure a value is an array and implode it
     *
     * @param mixed $value
     * @param string $separator
     * @return string
     */
    public static function ensureArrayAndImplode($value, string $separator = ', '): string
    {
        if (is_array($value)) {
            return implode($separator, $value);
        }

        if (is_string($value) && !empty($value)) {
            // Try to decode as JSON first
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return implode($separator, $decoded);
            }
            // If not valid JSON, treat as comma-separated string
            return $value;
        }

        return '';
    }
}
