CONTAINER_NAME=aisolutions-api

docker-install:
	make docker-build
	make docker-up
	make docker-composer-install
	make docker-clear

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-bash:
	make docker-up
	docker exec -it $(CONTAINER_NAME) sh

docker-build:
	docker-compose build

docker-composer-install:
	docker exec $(CONTAINER_NAME) composer install --no-interaction --no-scripts

docker-logs:
	docker-compose logs --follow

docker-test:
	docker exec -t $(CONTAINER_NAME) composer unit-test

docker-migrate:
	docker exec $(CONTAINER_NAME) php artisan db:wipe
	docker exec $(CONTAINER_NAME) php -d memory_limit=-1 artisan migrate --seed

docker-clear:
	docker exec $(CONTAINER_NAME) sh -c "php artisan optimize:clear"
