help:
	@echo "Please use 'make <target>' where <target> is one of:"
	@echo "  test          to perform unit tests."
	@echo "  test-filter   to perform unit tests with filter."
	@echo "  phpstan       to run phpstan on the codebase."
	@echo "  psalm         to run psalm on the codebase."
	@echo "  fixer-fix     to run php-cs-fixer on the codebase, writing the changes."
	@echo "  fixer-check   to run php-cs-fixer on the codebase, just check."
	@echo "  all           to run 'test', 'psalm', 'phpstan' and 'fixer' before push."

test: 
	php vendor/bin/phpunit

test-filter:
	php vendor/bin/phpunit --filter $(filter-out $@,$(MAKECMDGOALS))

psalm:
	php vendor/bin/psalm

phpstan:
	php vendor/bin/phpstan

fixer-fix:
	php vendor/bin/php-cs-fixer fix --diff

fixer-check:
	php vendor/bin/php-cs-fixer fix --diff --dry-run

all:
	php vendor/bin/phpunit
	php vendor/bin/psalm
	php vendor/bin/phpstan
	php vendor/bin/php-cs-fixer fix --diff

%:
	@: