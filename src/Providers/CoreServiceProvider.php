<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Core\Project\Providers;

use Core\Project\Console\Commands\CommandResetLogEmail;
use Core\Project\Illuminate\LogEmail\LogEmailEvent;
use Core\Project\Illuminate\LogEmail\LogEmailListener;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->commands([
            CommandResetLogEmail::class,
        ]);
    }

    public function boot(): void
    {
        Event::listen(
            LogEmailEvent::class,
            LogEmailListener::class
        );

        $this->publishesConfig();
    }

    public function publishesConfig(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ],'core_project_migrate');
    }

    public function setUpSchedule()
    {
        // Đăng ký lịch trình
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('logs-email:delete-old 30')->weekly();
        });
    }
}