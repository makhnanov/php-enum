FROM php:latest
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt update && apt -y install zip
WORKDIR /app
