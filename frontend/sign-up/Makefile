APP := app
DC := docker compose run

start:
	docker compose up -d --remove-orphans

stop:
	docker compose down

restart: stop start

ssh:
	@$(DC) $(APP) sh

build:
	@$(DC) $(APP) npm run build


# awqw