<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 7/25/24
 */

namespace Helpers\Project\Providers;

use Core\Project\Illuminate\LogEmail\LogEmailEvent;
use Core\Project\Illuminate\LogEmail\LogEmailListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register() : void
    {

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
}