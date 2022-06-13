<?php

namespace App\Providers;

use App\Events\UserLastLoginEvent;
use App\Listeners\UserLastLoginListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLastLoginEvent::class => [
			UserLastLoginListener::class
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
                // ... other providers
                \SocialiteProviders\VKontakte\VKontakteExtendSocialite::class.'@handle',
            ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
                // ... other providers
                \SocialiteProviders\GitHub\GitHubExtendSocialite::class.'@handle',
            ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
