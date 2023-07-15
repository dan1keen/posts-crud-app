<?php

namespace App\Providers;

use App\Contracts\Auth\AuthenticationServiceContract;
use App\Contracts\Auth\RegistrationServiceContract;
use App\Contracts\PostApiContract;
use App\Contracts\PostServiceContract;
use App\Contracts\UserRepositoryContract;
use App\Repositories\Api\DummyJsonApi;
use App\Repositories\Eloquent\UserRepository;
use App\Services\Auth\Basic\AuthenticationService;
use App\Services\Auth\Basic\RegistrationService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegistrationServiceContract::class   => RegistrationService::class,
        AuthenticationServiceContract::class => AuthenticationService::class,
        PostServiceContract::class           => PostService::class,


        UserRepositoryContract::class    => UserRepository::class,
        PostApiContract::class    => DummyJsonApi::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
