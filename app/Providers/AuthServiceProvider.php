<?php

namespace App\Providers;

use App\ExternalApiUserProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // you can choose a different name
        // Auth::provider('external', function() {
        //     return new ExternalApiUserProvider();
        // });
        Auth::provider('external', function ($app, array $config) {
            return new ExternalApiUserProvider();
        });
    }
}
