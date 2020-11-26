cp .env.example.docker .env && \
	composer install && \
    php artisan key:generate && \
    php artisan migrate && \
    php artisan db:seed && \
    php artisan permissible:setup