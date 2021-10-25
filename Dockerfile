FROM php:8.1.0RC4-cli-alpine3.14
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
WORKDIR /app
CMD ["./entrypoint.sh"]
