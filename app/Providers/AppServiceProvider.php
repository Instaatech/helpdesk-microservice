<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\MessageContract;
use App\Contracts\TicketContract;
use App\Contracts\UserContract;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\MessageRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TicketContract::class, function ($app) {
            return new TicketRepository(new Ticket());
        });

        $this->app->bind(CategoryContract::class, function ($app) {
            return new CategoryRepository(new Category());
        });

        $this->app->bind(MessageContract::class, function ($app) {
            return new MessageRepository(new TicketMessage());
        });

        $this->app->bind(UserContract::class,function ($app) {
            return new UserRepository(new User());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Passport::routes();

        // Passport::tokensExpireIn(now()->addDays(15));
        // Passport::refreshTokensExpireIn(now()->addDays(30));
        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
