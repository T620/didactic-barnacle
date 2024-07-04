install:
	./install.sh

coverage:
	docker exec -it Jadu_php-fpm ./vendor/bin/pest --coverage
