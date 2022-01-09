DIR = $(shell pwd)
NAME = "php-enum"
CMD = docker run -it --mount type=bind,source=$(DIR),target=/app,bind-propagation=shared -w /app $(NAME)
run-build:
	docker build -t $(NAME) .
run-php-v:
	$(CMD) php -v
run-shell:
	$(CMD) sh
run-composer-install:
	$(CMD) composer install --prefer-dist
run-composer-update:
	$(CMD) composer update
run-example-basic:
	$(CMD) php Example/basic.php
run-example-extension:
	$(CMD) php Example/extension.php
run-test:
	$(CMD) php vendor/bin/phpunit
run-debug:
	$(CMD) php debug.php
run-report:
	xdg-open .html/index.html
