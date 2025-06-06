.PHONY: create-network remove-network

create-network:
	docker network create intranet || true

remove-network:
	docker network rm intranet || true