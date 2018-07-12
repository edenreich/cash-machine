<?php

namespace App\Providers;

use App\Classes\CashMachine;
use App\Interfaces\CashMachineInterface;
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
        $this->app->bind(CashMachineInterface::class, CashMachine::class);
    }
}
