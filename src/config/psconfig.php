<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Ambiente do PagSeguro
  |--------------------------------------------------------------------------
  |
  | O PagSeguro fornece um ambiente de testes(sandbox).
  | As opções são: prod, dev.
  |
  */
  'ambiente' => 'dev', // prod

  /*
  |--------------------------------------------------------------------------
  | Credenciais da API do PagSeguro
  |--------------------------------------------------------------------------
  |
  | Você precisa ter um email e um token válidos para utilizar a API do PagSeguro.
  | Mais Informações: https://pagseguro.uol.com.br/v2/guia-de-integracao/
  |
  */
  'email' => 'emaildopagseguro@teste.com',
  'token' => 'tokenGeradoPagSeguro'
];
