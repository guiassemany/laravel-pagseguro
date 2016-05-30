<?php
namespace GuiAssemany\LaravelPagSeguro;


use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use Illuminate\Support\ServiceProvider;

class PagseguroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . "/config/psconfig.php" => config_path('psconfig.php')]);
    }

    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Verifica o ambiente
        |--------------------------------------------------------------------------
        */
        if (config('psconfig.ambiente') == "dev") {
            $this->app->bind('PagseguroEnv', function () {
                return new Sandbox();
            });
        } else {
            $this->app->bind('PagseguroEnv', function () {
                return new Production();
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Cria instancia das Credenciais de acordo com o ambiente
        |--------------------------------------------------------------------------
        */
        $this->app->bind('PHPSC\PagSeguro\Credentials', function () {
            return new Credentials(
                config('psconfig.email'),
                config('psconfig.token'),
                $this->app->make('PagseguroEnv')
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Cria instancia do Checkout
        |--------------------------------------------------------------------------
        */
        $this->app->bind('PHPSC\PagSeguro\Requests\Checkout\CheckoutService', function () {
            return new CheckoutService($this->app->make('PHPSC\PagSeguro\Credentials'));
        });

    }
}
