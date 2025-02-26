<?php

declare(strict_types = 1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configModels();
        $this->configCommands();
        $this->configUrls();
        $this->configDate();
    }

    private function configModels(): void
    {
        Model::shouldBeStrict(
            ! app()->isProduction()
        );

        Model::unguard();
    }

    private function configCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    private function configUrls(): void
    {
        if (app()->isLocal()) {
            return;
        }

        URL::forceHttps();
    }

    private function configDate(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
