<?php

namespace App\Providers;

use App\Interfaces\LikeInterface;
use App\Interfaces\PasswordResetInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserSettingsInterface;
use App\Repositories\LikeRepository;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserSettingsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserSettingsInterface::class,UserSettingsRepository::class);
        $this->app->bind(PasswordResetInterface::class,PasswordResetRepository::class);
        $this->app->bind(LikeInterface::class,LikeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
