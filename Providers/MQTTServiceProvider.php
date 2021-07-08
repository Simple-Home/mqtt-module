<?php

namespace Modules\MQTT\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SettingManager;

class MQTTServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /** Settings this integration needs to create  */
    public function createSettings()
    {
        SettingManager::register('host', 'localhost', 'string', 'mqtt');
        SettingManager::register('port', '1883', 'string', 'mqtt');
        SettingManager::register('username', '', 'string', 'mqtt');
        SettingManager::register('password', '', 'string', 'mqtt');
    }

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->createSettings();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/MQTT');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'MQTT');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'MQTT');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
