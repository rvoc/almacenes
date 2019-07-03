
# Sistema de Almacenes

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

### Tecnologia  

 <a href="https://laravel.com"><img alt="Laravel" src="https://laravel.com/assets/img/components/logo-laravel.svg" width="220" /> </a>
 <a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="80" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a>

### Instalacion

configure la base de datos en el archivo .env

```sh
$ cp .env.example .env  
```
ejecutar los comandos en el siguiente orden

```sh
$ composer install    
$ php artisan key:generate     
$ php artisan migrate --seed
$ npm install 
```
para colocar el proyecto en produccion
```sh
$ npm run prod
```
para colocar el proyecto en modo desarrollo 
```sh
$ npm run dev
```
###### Opcionalmente puede utilizar yarn


lokotos