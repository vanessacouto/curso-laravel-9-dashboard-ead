<?php

namespace App\Providers;

use App\Repositories\Eloquent\{
    AdminRepository,
    UserRepository,
    CourseRepository,
    ModuleRepository,
    LessonRepository,
    SupportRepository,
    ReplySupportRepository
};

use App\Repositories\{
    AdminRepositoryInterface,
    UserRepositoryInterface,
    CourseRepositoryInterface,
    ModuleRepositoryInterface,
    LessonRepositoryInterface,
    SupportRepositoryInterface,
    ReplySupportRepositoryInterface
};

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class 
        );

        $this->app->singleton(
            AdminRepositoryInterface::class,
            AdminRepository::class 
        );

        $this->app->singleton(
            CourseRepositoryInterface::class,
            CourseRepository::class 
        );

        $this->app->singleton(
            ModuleRepositoryInterface::class,
            ModuleRepository::class 
        );

        $this->app->singleton(
            LessonRepositoryInterface::class,
            LessonRepository::class 
        );

        $this->app->singleton(
            SupportRepositoryInterface::class,
            SupportRepository::class 
        );

        $this->app->singleton(
            ReplySupportRepositoryInterface::class,
            ReplySupportRepository::class 
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
