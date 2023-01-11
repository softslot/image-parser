start:
	php -S localhost:3000 -t src

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src