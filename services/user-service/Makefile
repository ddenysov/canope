APP := app
DC := docker compose exec

start:
	docker compose up -d --remove-orphans

stop:
	docker compose down

restart: stop start

ssh:
	@$(DC) $(APP) sh

migrate:
	@$(DC) $(APP) vendor/bin/doctrine-migrations migrations:migrate

generate-migration:
	@$(DC) $(APP) vendor/bin/doctrine-migrations migrations:generate


install:
	@$(DC) $(APP) composer install

tail:
	@$(DC) $(APP) tail -f var/log/local.log

# awqw