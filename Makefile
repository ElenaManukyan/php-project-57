start:
	php artisan serve & npm run dev

test:
	php artisan test

migrate:
	php artisan migrate

rebuild:
	npm install && npm run build

clear-cashe:
	php artisan view:clear && php artisan cache:clear

lint:
	composer exec phpcs -- --standard=PSR12 app tests routes database config

lint-fix:
	composer exec phpcbf -- --standard=PSR12 app tests routes database config