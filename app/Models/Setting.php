<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    private static ?array $cache = null;

    public static function allValues(): array
    {
        if (self::$cache === null) {
            try {
                self::$cache = static::query()->pluck('value', 'key')->all();
            } catch (\Throwable $e) {
                self::$cache = [];
            }
        }

        return self::$cache;
    }

    public static function flush(): void
    {
        self::$cache = null;
    }
}