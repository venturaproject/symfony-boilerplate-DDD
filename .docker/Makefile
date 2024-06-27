enter-mysql-container:
	@docker exec -it db bash

enter-php-container:
	@docker exec -it php bash
	
dump-db:
	@docker exec db sh -c 'mysqldump -u root -proot symfony > /mysql/db_dump.sql'
	@docker cp db:/mysql/db_dump.sql ./mysql/db_dump.sql

clear-cache:
	@docker exec -it php php bin/console cache:clear

info-commands:
	@docker exec -it php php bin/console list

