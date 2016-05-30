# Integração do Laravel com o Pagseguro
![PagSeguro](https://raw.github.com/guiassemany/laravel-pagseguro/master/docs/pagseguro.png)
## Instalação
* Vá para a pasta do seu projeto
* Execute ``` composer require guiassemany/laravel-pagseguro ```
* Se ao executar o comando acima, existirem problemas em relação à requisitos mínimos de versão do pacote, adicione ao seu composer.json:
```
...
"minimum-stability": "dev",
"prefer-stable" : true
```

Após o pacote ter sido baixado, abra o arquivo config/app.php e adicione o Service Provider do pacote no array 'providers' que está dentro deste arquivo.

```php
'providers' => [
    //...
    //...
    //...
    GuiAssemany\LaravelPagSeguro\PagseguroServiceProvider::class,
]
```
Abra o terminal de sua preferência, e dentro da pasta do seu projeto execute o comando:

```bash
php artisan vendor:publish
```

Este comando irá publicar o arquivo de configuração **psconfig.php** dentro da pasta config do laravel.

No arquivo **config/psconfig.php**, você poderá editar o ambiente desejado para o PagSeguro(dev ou prod), o e-mail da conta e o TOKEN.

## Utilizando a partir de um controller
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class PagSeguroController extends Controller
{
  public function index(CheckoutService $checkoutService)
  {

      $checkout = $checkoutService->createCheckoutBuilder()
          ->addItem(new Item(2, 'Playstation 4', 1499.99))
          ->addItem(new Item(1, 'UFC 2 - PS4', 250.00))
          ->addItem(new Item(2, 'GTA V - PS4', 230.00))
          ->getCheckout();

      $response = $checkoutService->checkout($checkout);

      return redirect($response->getRedirectionUrl());

  }
}

```
