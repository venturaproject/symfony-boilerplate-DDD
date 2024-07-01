## 🐳 Docker + PHP 8.3 + MySQL + Nginx + Symfony 7 Boilerplate

## Description

This is a complete stack for running Symfony 7.0 in Docker containers using docker-compose tool.

It is composed by 3 containers:

- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 8.3 version of PHP.
- `db`, MySQL database container with a MySQL 8.0 image.
- `rabbitmq`, RabbitMQ container.
- `redis`, Redis container.



## Installation

 Clone this repo.
 Go inside `./docker` folder and run `docker compose up -d` to start containers.
 run `make install-composer` or `make enter-php-container` and `composer install`

## Api Platform

 Browse Open API Platform docs: http://localhost/api/doc  







