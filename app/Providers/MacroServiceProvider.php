<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the haversine query macro.
        Builder::macro('haversine', function ($latitude, $longitude) {
            // Haversine in SI units (kilometres) as query builder macro
            return $this->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$latitude, $longitude, $latitude]);
        });
    }
}
