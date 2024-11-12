<?php

return [

    // Default Authentication Guard
    'defaults' => [
        'guard' => 'web',  // Default to 'web' guard
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'volunteers', // or 'users'
        ],

        'organization' => [
            'driver' => 'session',
            'provider' => 'organizations',
        ],

        'volunteer' => [
            'driver' => 'session',
            'provider' => 'volunteers',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'organizations' => [
            'driver' => 'eloquent',
            'model' => App\Models\Organization::class,
        ],

        'volunteers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Volunteer::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],


    // Password Reset Settings
    'passwords' => [
        'volunteers' => [
            'provider' => 'volunteers',  // Password reset provider for volunteers
            'table' => 'password_resets',  // The table used to store reset tokens
            'expire' => 60,  // Token expires in 60 minutes
            'throttle' => 60,  // Throttle reset attempts to prevent abuse
        ],

        'organizations' => [
            'provider' => 'organizations',  // Password reset provider for organizations
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',  // Password reset provider for admins
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    // Throttle Login Attempts
    'password_timeout' => 10800,  // Logout after 3 hours of inactivity (10800 seconds)

];
