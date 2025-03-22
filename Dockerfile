FROM php:8.1-cli
WORKDIR /app
COPY . .
RUN apt-get update && apt-get install -y unzip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist
ENTRYPOINT ["tail", "-f", "/dev/null"]