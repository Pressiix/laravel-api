prepare:
	docker compose down
	docker compose up --build -d
	docker compose exec app bash -c "chown -R www-data:www-data /var/www/apps/storage /var/www/apps/bootstrap/cache"
	docker compose exec app bash -c "chmod -R 775 /var/www/apps/storage /var/www/apps/bootstrap/cache"
	make migrate

install: i
i:
	docker compose exec app bash -c "cd apps && composer install && composer dump-autoload"

clean:
	docker compose exec app bash -c "cd apps && rm -rf vendor"

keygen:
	docker compose exec app bash -c "cd apps && php artisan key:generate"

# Run database migrations
migrate:
	make clean
	make install
	docker compose exec app bash -c "cd apps && php artisan migrate"
	make keygen

run:
	docker compose exec app bash -c "cd apps && composer dump-autoload"
	docker compose logs -f --tail=100 app
