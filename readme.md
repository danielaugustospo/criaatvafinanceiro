## SISTEMA DE GERENCIAMENTO FINANCEIRO COM LARAVEL 5.8 - Sistema atualmente com php 7.4

![image](https://user-images.githubusercontent.com/15149508/160742903-459d2041-d061-4933-8e6d-d995de00ca1d.png)
![image](https://user-images.githubusercontent.com/15149508/160743188-5b39aebc-3968-468a-bb90-c8fd2e4265b8.png)
![image](https://user-images.githubusercontent.com/15149508/160743520-829cbdc8-f78b-4372-8997-1c101a7fb788.png)

Criei esse projeto inicial no docker em outro repositório, caso queira acompanhar, clique [aqui](https://github.com/danielaugustospo/docker_criaatva)

## Tutorial de configuração
----------------------------------------------------------------------------------------------------------------------------
Comandos:

php artisan make:migration create_users_table --create=users

php artisan make:migration add_votes_to_users_table --table=users

Foi criado um link simbólico para a pasta storage em public. Para gerar esse comando no servidor, execute:

php artisan storage:link

php artisan migrate --force

php artisan migrate:refresh

php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder

// Refresh the database and run all database seeds...
php artisan migrate:refresh --seed

Modo de manutenção
php artisan down --allow=192.168.0.55 --message="Em Manutenção"
php artisan up

----------------------------------------------------------------------------------------------------------------------------
## Instalação Validador

No arquivo `composer.json`, adicione validator-docs como dependência do seu projeto:

```
"require": {
    "geekcom/validator-docs" : "^3.3"
 },
```

Depois execute:

```
composer install
```

Ou simplesmente execute o comando:

```
composer require geekcom/validator-docs
```

----------------------------------------------------------------------------------------------------------------------------

## Como usar - Validações disponíveis

Agora, você terá os métodos de validação validator docs Brasil disponíveis.

* **cpf** - Verifica se um CPF é valido.

```php
$this->validate($request, [
    'cpf' => 'required|cpf',
]);
```

* **cnpj** - Verifica se um CNPJ é valido.

```php
$this->validate($request, [
    'cnpj' => 'required|cnpj',
]);
```

* **cnh** - Verifica se uma CNH (Carteira Nacional de Habilitação) é válida.

```php
$this->validate($request, [
    'cnh' => 'required|cnh',
]);
```

* **titulo_eleitor** - Verifica se um Título de Eleitor é válido.

```php
$this->validate($request, [
    'titulo_eleitor' => 'required|titulo_eleitor',
]);
```

* **cpf_cnpj** - Verifica se um CPF ou CNPJ é válido.

```php
$this->validate($request, [
    'cpf_cnpj' => 'required|cpf_cnpj',
]);
```

* **nis** - Verifica se um PIS/PASEP/NIT/NIS é válido.

```php
$this->validate($request, [
    'nis' => 'required|nis',
]);
```

* **cns** - Verifica se um Cartão Nacional de Saúde (CNS) é válido.

```php
$this->validate($request, [
    'cns' => 'required|cns',
]);
```

* **certidao** - Verifica se uma certidão de nascimento/casamento/óbito é válida.

```php
$this->validate($request, [
    'certidao' => 'required|certidao',
]);
```

* **formato_cnpj** - Verifica se o formato de um CNPJ é válida. ( 99.999.999/9999-99 )

```php
$this->validate($request, [
    'formato_cnpj' => 'required|formato_cnpj',
]);
```

* **formato_cpf** - Verifica se o formato de um CPF é válido. ( 999.999.999-99 )

```php
$this->validate($request, [
    'formato_cpf' => 'required|formato_cpf',
]);
```

* **formato_cpf_cnpj** - Verifica se o formato de um CPF ou um CNPJ é válido. ( 999.999.999-99 ) ou ( 99.999.999/9999-99 )

```php
$this->validate($request, [
    'formato_cpf_cnpj' => 'required|formato_cpf_cnpj',
]);
```

* **formato_nis** - Verifica se o formato de um PIS/PASEP/NIT/NIS é válido. ( 999.99999-99.9 )

```php
$this->validate($request, [
    'formato_nis' => 'required|formato_nis',
]);
```

* **formato_certidao** - Verifica se o formato de uma certidão é válida. ( 99999.99.99.9999.9.99999.999.9999999-99 ou 99999 99 99 9999 9 99999 999 9999999 99)

```php
$this->validate($request, [
    'formato_certidao' => 'required|formato_certidao',
]);
```
----------------------------------------------------------------------------------------------------------------------------

## Combinando validação e formato

No exemplo abaixo, fazemos um teste onde verificamos a formatação e a validade de um CPF ou CNPJ, para os casos onde a informação deve ser salva em um mesmo atributo:

```php
$this->validate($request, [
    'cpf_or_cnpj' => 'formato_cpf_cnpj|cpf_cnpj',
]);
```

----------------------------------------------------------------------------------------------------------------------------
## Exemplo de uso em um controller

Método de validação de exemplo em um controller com todas as possibilidades de validação

```php
public function store(Request $request)
{
    $data = $request->all();

    $this->validate($request, [
        'cpf' => 'required|cpf',
        'cnpj' => 'required|cnpj',
        'cnh' => 'required|cnh',
        'titulo_eleitor' => 'required|titulo_eleitor',
        'nis' => 'required|nis',
        'cns' => 'required|cns',
    ]);

    dd($data);
}
```
## Documentação select2
https://select2.org/configuration

----------------------------------------------------------------------------------------------------------------------------

## Geradores de documentos para testes

* **CNH** - http://4devs.com.br/gerador_de_cnh
* **TÍTULO ELEITORAL** - http://4devs.com.br/gerador_de_titulo_de_eleitor
* **CNPJ** - http://www.geradorcnpj.com/
* **CPF** - http://geradordecpf.org
* **NIS** - https://www.4devs.com.br/gerador_de_pis_pasep
* **CNS** - https://geradornv.com.br/gerador-cns/
* **CERTIDÃO** - https://www.treinaweb.com.br/ferramentas-para-desenvolvedores/gerador/certidao
