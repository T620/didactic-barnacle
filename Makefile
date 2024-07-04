install:
	./install.sh

up:
	docker-compose up -d

down:
	docker-compose down

coverage:
	docker exec -it Jadu_php-fpm ./vendor/bin/pest --coverage
