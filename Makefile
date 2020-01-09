.PHONY: clean install test

clean:
	@rm -rf vendor composer.lock

install: clean
	composer install

test: install
	vendor/bin/phpunit test/unit
