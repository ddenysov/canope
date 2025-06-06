.PHONY: create-network remove-network

start-infra: start-gateway

stop-infra: stop-gateway

create-network:
	docker network create intranet || true

remove-network:
	docker network rm intranet || true

start-gateway:
	docker compose -f gateway/docker-compose.yml up -d

stop-gateway:
	docker compose -f gateway/docker-compose.yml down