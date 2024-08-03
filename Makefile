prepare:
	docker-compose down
	docker-compose up --build -d
	docker-compose exec app bash -c "chown -R www-data:www-data /var/www/apps/storage /var/www/apps/bootstrap/cache"
	docker-compose exec app bash -c "chmod -R 775 /var/www/apps/storage /var/www/apps/bootstrap/cache"
	make migrate
	docker-compose exec app bash -c "php artisan install:api"

# Run database migrations
migrate:
	docker-compose exec app bash -c "cd /var/www/apps && php artisan migrate"