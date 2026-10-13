<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Application services
        $this->app->singleton(
            \App\Application\Services\LoginService::class,
            \App\Application\Services\LoginService::class
        );
        
        // Bind ports to adapters (Article II, III)
        // These will be implemented in Infrastructure adapters
        $this->app->bind(
            \App\Application\Ports\Outbound\BookRepository::class,
            \App\Infrastructure\Outbound\Persistence\EloquentBookRepository::class
        );
        
        $this->app->bind(
            \App\Application\Ports\Outbound\UserRepository::class,
            \App\Infrastructure\Outbound\Persistence\EloquentUserRepository::class
        );
        
        $this->app->bind(
            \App\Application\Ports\Outbound\PasswordHasher::class,
            \App\Infrastructure\Outbound\Security\BcryptPasswordHasher::class
        );
        
        $this->app->bind(
            \App\Application\Ports\Outbound\TokenIssuer::class,
            \App\Infrastructure\Outbound\Security\JwtTokenIssuer::class
        );
    }

    public function boot(): void
    {
        //
    }
}