ROOT_DIR       := $(shell dirname $(realpath $(lastword $(MAKEFILE_LIST))))
SHELL          := $(shell which bash)
PROJECT_NAME    = thrivecart
ARGS            = $(filter-out $@,$(MAKECMDGOALS))

.SILENT: ;               # no need for @
.ONESHELL: ;             # recipes execute in same shell
.NOTPARALLEL: ;          # wait for this target to finish
.EXPORT_ALL_VARIABLES: ; # send all vars to shell
default: help-default;   # default target
Makefile: ;              # skip prerequisite discovery

.title:
	$(info Phalcon Compose: $(VERSION))
	$(info )

help-default help: .title
	$(info Usage: make [target] [ARGS=value])
	$(info Targets:)
	$(info   build       Build the project)
	$(info   up          Start the project)
	$(info   dev         Start the project in development mode)
	$(info   stop        Stop the project)
	$(info   status      Show the project status)
	$(info   reset       Stop and remove the project)
	$(info   root        Enter the container as root)
	$(info   clean       Stop and remove the project)
	$(info   logs        Show the logs)
	$(info   test-dev    Run the tests)
build:
	docker-compose --project-name $(PROJECT_NAME) build
up:
	docker-compose --project-name $(PROJECT_NAME) up -d

dev: build up

stop:
	docker-compose --project-name $(PROJECT_NAME) stop

status:
	docker-compose --project-name $(PROJECT_NAME) ps

reset: stop clean build up

root:
	docker exec -it -u root $$(docker-compose --project-name $(PROJECT_NAME) ps -q app) /bin/bash

clean: stop
	docker-compose --project-name $(PROJECT_NAME) down --remove-orphans
logs:
	docker logs -f $$(docker-compose --project-name $(PROJECT_NAME) ps -q app)
analyse:
	docker exec -it $$(docker-compose --project-name $(PROJECT_NAME) ps -q app) vendor/bin/phpstan analyse
test-dev:
	docker exec -it $$(docker-compose --project-name $(PROJECT_NAME) ps -q app) vendor/bin/phpunit tests
%:
	@:
