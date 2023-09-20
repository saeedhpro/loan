<?php

namespace App\Providers;

use App\Interfaces\BaseInterface;
use App\Interfaces\LoanInterface;
use App\Interfaces\PermissionInterface;
use App\Interfaces\UserInterface;
use App\Models\Loan;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\LoanRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            BaseInterface::class,
            BaseRepository::class
        );
        $this->app->bind(
            UserInterface::class,
            function() {
                return new UserRepository(new User);
            }
        );
        $this->app->bind(
            PermissionInterface::class,
            function() {
                return new PermissionRepository(new Permission);
            }
        );
        $this->app->bind(
            LoanInterface::class,
            function() {
                return new LoanRepository(new Loan);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
