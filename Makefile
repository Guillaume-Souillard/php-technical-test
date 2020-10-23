SHELL := /bin/bash
DOCKER_FILE := docker-compose.yml
COMPOSE := docker-compose -f
CONTAINER_ID_BASH := stadline-app

all: up

up:
	$(COMPOSE) $(DOCKER_FILE) up -d

bash:
	docker-compose exec app bash

down:
	docker-compose down
