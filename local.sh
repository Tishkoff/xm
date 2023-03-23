#!/bin/bash

function _up() {
  docker-compose --env-file ./src/.env up -d
  [ ! -d "src/vendor" ] && docker-compose --env-file ./src/.env exec app composer install
}

function _stop() {
  docker-compose --env-file ./src/.env stop
}

function _rebuild() {
  docker-compose --env-file ./src/.env up -d --build --force-recreate --remove-orphans
}

function _ssh() {
  docker-compose --env-file ./src/.env exec app bash
}

function _test() {
  docker-compose --env-file ./src/.env exec app php artisan test
}

case $1 in
"start") _up ;;
"stop") _stop ;;
"rebuild") _rebuild ;;
"ssh") _ssh ;;
"test") _test ;;
esac