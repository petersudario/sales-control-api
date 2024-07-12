<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Aplicação web criada por Pedro Henrique Sudario da Silva
Este projeto foi criado com os frameworks Laravel 11, Leaflet e ReactJS


> # Step by step
> ## Dependências requeridas:
> PHP 8.3.7
> 
> Composer 2.2.6 (package manager)
> 
> npm 10.5.0 (package manager)
>
> Node v21.7.1
> 
> Uma database MySQL 8 (ou MariaDB)

> ## Step 1
> Clone o repositório no lugar que preferir

> ## Step 2
> Abra um terminal e navegue até a pasta usando o comando "cd", seja no Linux ou Windows. Ex: cd /home/User/Downloads/sales-control-api

> ## Step 3
> Após ter instalado as dependências no topo deste readme, execute o comando "composer install" dentro da root do projeto

> ## Step 4
> Execute o comando "npm install" na root do projeto

> ## Step 5
> Execute o comando "php artisan migrate" para criar a database com todas as estruturas pré-criadas (se certifique que o arquivo ".env.example" se encontra renomeado como ".env" e com as configurações necessárias do seu ambiente para a database, a partir da linha 22 do arquivo).
> 
> ## /home/user/Downloads/sales-control-api/.env.example
> 
> ![image](https://github.com/petersudario/sales-control-api/assets/84980739/feb4f83f-6911-4527-accb-be5ee54ef9da)

> ## Step 6
> Abra mais um terminal na mesma pasta, e digite o comando "php artisan serve" no primeiro terminal

> ## Step 7
> Execute o comando "npm run dev" no segundo terminal para iniciar o vite.js

> ## Step 8
> Execute o comando "php artisan db:seed --class=DatabaseSeeder" para popular a database com os dados necessários dos usuários



> ## Aplicação pronta para ser usada no DEV environment. Abra o localhost:8000 no Browser e realize o login.
