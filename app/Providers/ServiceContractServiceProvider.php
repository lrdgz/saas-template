<?php

namespace App\Providers;

use App\Services\{
    AuthenticationService,
    PostCategoryService,
    PostService
};

use App\Services\Contracts\{
    AuthenticationContract,
    PostCategoryContract,
    PostContract
};

use Illuminate\Support\ServiceProvider;

class ServiceContractServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AuthenticationContract::class, AuthenticationService::class);
        $this->app->singleton(PostCategoryContract::class, PostCategoryService::class);
        $this->app->singleton(PostContract::class, PostService::class);
    }

    public function boot(): void
    {
    }

}
