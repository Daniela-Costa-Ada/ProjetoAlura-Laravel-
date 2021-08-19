<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\NovaSerie::class => [
            \App\Listeners\EnviarEmailNovaSerieCadastrada::class, 
            \App\Listeners\LogNovaSerieCadastrada::class
        ]/*,
        \App\Events\SerieApagada::class=> [
            \App\Listeners\ExcluirCapaSerie::class
        ]*/
    ];//registro dos eventos e listeners ao criar uma serie nova emails são enviados e logs são gerados

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
