<?php

use Illuminate\Support\Facades\Route;
use App\Models\School;

if (!function_exists('isActive')) {
    function isActive($routes)
    {
        foreach ((array)$routes as $route) {
            if (Route::is($route)) {
                return 'active';
            }
        }
        return '';
    }
}

if (!function_exists('isMenuOpen')) {
    function isMenuOpen($routes)
    {
        foreach ((array)$routes as $route) {
            if (Route::is($route)) {
                return 'menu-open';
            }
        }
        return '';
    }
}

if (!function_exists('getSchoolProfile')) {
    function getSchoolProfile()
    {
        $school = School::first();
        if (!$school || !$school->name) {
            return (object)[
                'name' => 'TinyTots',
                'code' => 'TTS',
                'address' => '123 Tiny Tots Lane',
                'phone' => '123-456-7890',
                'email' => '',
                'website' => '',
                'logo' => null,
            ];
        }
        return School::first();
    }
}
