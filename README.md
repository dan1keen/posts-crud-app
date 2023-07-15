## Installation

Steps:

- 1) git clone https://github.com/dan1keen/posts-crud-app.git
- 2) cp .env.example .env
- 3) docker run --rm     -u "$(id -u):$(id -g)"     -v "$(pwd):/var/www/html"     -w /var/www/html     laravelsail/php82-composer:latest     composer install --ignore-platform-reqs
- 4) vendor/bin/sail up
- 5) docker-compose exec --user sail laravel.test bash
- 6) php artisan migrate

