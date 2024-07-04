#!/bin/bash

echo "installing composer dependencies"
composer install

echo "building containers"
docker-compose build

echo "starting containers"
docker-compose up -d

echo "Install complete."
