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
	$(CMD) php Example/basic.php
run-test:
	$(CMD) php vendor/bin/phpunit
run-one-test:
	$(CMD) php vendor/bin/phpunit --filter testPositive Test/CamelCaseTest.php
run-psalm:
	$(CMD) php vendor/bin/psalm --show-info=true
run-infection:
	$(CMD) php vendor/bin/infection --test-framework=phpunit --coverage=.build/coverage --threads=4
run-debug:
	$(CMD) php debug.php
run-report:
	xdg-open .html/index.html
