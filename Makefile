#!/usr/bin/make

SHELL = /bin/sh

UID := $(shell id -u)
GID := $(shell id -g)

export UID
export GID

build:
	docker build --build-arg UID=${UID} -t psql2sql:latest .

up:
	docker run -v ${PWD}/app:/var/www/html -it psql2sql:latest sh

down:
	docker down --remove-orphans