# Default target
.PHONY: help
help:
	@echo "Usage:"
	@echo "  make create.controller name=ControllerName"
	@echo "  make create.model name=ModelName"
	@echo "  make create.view name=ViewName"
	@echo "  make create.migration name=MigrationName"
	@echo "  make create.seed name=SeederName"

prepare:
	docker compose down
	docker compose up --build -d
	docker compose exec app bash -c "chown -R www-data:www-data /var/www/apps/storage /var/www/apps/bootstrap/cache"
	docker compose exec app bash -c "chmod -R 775 /var/www/apps/storage /var/www/apps/bootstrap/cache"
	make migrate

install: i
i:
	make clean
	docker compose exec app bash -c "cd apps && composer install && composer dump-autoload"

clean:
	docker compose exec app bash -c "cd apps && rm -rf vendor"

keygen:
	docker compose exec app bash -c "cd apps && php artisan key:generate"

# Run database migrations
migrate:
	docker compose exec app bash -c "cd apps && php artisan migrate"
	make keygen

migrate.seed:
	docker compose exec app bash -c "cd apps && php artisan db:seed"

run:
	docker compose exec app bash -c "cd apps && composer dump-autoload"
	docker restart laravel_web
	docker compose logs -f --tail=100 app

# Create a Laravel controller
.PHONY: create.controller
create.controller:
	docker compose exec app bash -c "cd apps && php artisan make:controller $${name}"

# Create a Laravel model
.PHONY: create.model
create.model:
	docker compose exec app bash -c "cd apps && php artisan make:model $${name}"

# Create a Laravel view
.PHONY: create.view
create.view:
	docker compose exec app bash -c "cd apps && php artisan make:view $${name}"

# Create a Laravel migration
.PHONY: create.migration
create.migration:
	docker compose exec app bash -c "cd apps && php artisan make:migration $${name}"

# Create a Laravel seed
.PHONY: create.seed
create.seed:
	docker compose exec app bash -c "cd apps && php artisan make:seeder $${name}"
