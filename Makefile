build:
	docker-compose build

up:
	docker-compose up -d

stop:
	docker-compose stop

down:
	docker-compose down

bash:
	docker-compose exec muzirus_php sh -c "bash"

build-dev:
	docker-compose exec muzirus_php sh -c "composer dev"

build-prod:
	docker-compose exec muzirus_php sh -c "composer prod"

test:
	docker-compose exec muzirus_php sh -c "composer test"

phpstan:
	docker-compose exec muzirus_php sh -c "composer phpstan"

phpunit:
	docker-compose exec muzirus_php sh -c "composer phpunit"

cs:
	docker-compose exec muzirus_php sh -c "composer cs"

cs-fix:
	docker-compose exec muzirus_php sh -c "composer cs-fix"

# catch all target (%) which does nothing to silently ignore the other goals.
%:
	@true
