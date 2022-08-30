<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'applicant',
        'passwords' => 'applicants',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent applicant provider.
    |
    | All authentication drivers have a applicant provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your applicant's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'applicant' => [
            'driver' => 'session',
            'provider' => 'applicants',
        ],

        'manager' => [
            'driver' => 'session',
            'provider' => 'managers',
        ],

        'employer' => [
            'driver' => 'session',
            'provider' => 'employers',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Applicant Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a applicant provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your applicant's data.
    |
    | If you have multiple applicant tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'applicants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Applicant::class,
        ],

        'managers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Manager::class,
        ],

        'employers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employer::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one applicant table or model in the application and you want to have
    | separate password reset settings based on the specific applicant types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the applicant is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
