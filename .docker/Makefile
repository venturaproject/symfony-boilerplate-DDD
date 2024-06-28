
ifneq (,$(wildcard ./.env))
    include .env
    export $(shell sed 's/=.*//' .env)
endif

run:
	@docker-compose build --no-cache
	@docker-compose -p $(COMPOSE_PROJECT_NAME) up -d

enter-mysql-container:
	@docker exec -it $(MYSQL_CONTAINER) bash

enter-php-container:
	@docker exec -it $(PHP_CONTAINER) bash
	
install-composer:
	@docker exec -it $(PHP_CONTAINER) composer install

clear-cache:
	@docker exec -it $(PHP_CONTAINER) php bin/console cache:clear

info-commands:
	@docker exec -it $(PHP_CONTAINER) php bin/console list
