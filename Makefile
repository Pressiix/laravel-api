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
	docker compose up --build -d
	docker compose exec app bash -c "chown -R www-data:www-data /var/www/apps/storage /var/www/apps/bootstrap/cache"
	docker compose exec app bash -c "chmod -R 775 /var/www/apps/storage /var/www/apps/bootstrap/cache"
	make migrate

build:
	docker compose exec app bash -c "cd apps &&  composer dump-autoload"
	docker compose exec app bash -c "cd apps && ls && yarn build"

install: i
i:
	make clean
	docker compose exec app bash -c "cd apps && composer install"
	docker compose exec app bash -c "cd apps && yarn && yarn"

clean:
	docker compose exec app bash -c "cd apps && rm -rf vendor"

keygen:
	docker compose exec app bash -c "cd apps && php artisan key:generate"

# Run database migrations
migrate:
	docker compose exec app bash -c "cd apps && php artisan migrate"

migrate.seed:
	docker compose exec app bash -c "cd apps && php artisan db:seed"

run:
	docker compose exec app bash -c "cd apps && composer dump-autoload"
	docker restart laravel_web
	docker compose exec app bash -c "cd apps && yarn dev --port 3000"

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

go.shell:
	docker compose exec app bash
