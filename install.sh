#!/bin/bash

echo "                                 ";
echo "       _____    ____  __  __     ";
echo "      / /   |  / __ \/ / / /     ";
echo " __  / / /| | / / / / / / /      ";
echo "/ /_/ / ___ |/ /_/ / /_/ /       ";
echo "\____/_/  |_/_____/\____/        ";
echo "                                 ";
echo "                                 ";

printf "\nInstalling composer dependencies\n"
composer install

printf "\n Installing SSL Certifications for TLS\n"
mkdir -p certs
cd certs || exit
mkcert -install localhost

echo "Setting up environment"
echo "APP_NAME=Jadu" >> .env

printf "\nBuilding containers...\n"
docker-compose build

printf "\nStarting containers...\n"
docker-compose up -d
docker-compose ps

printf "\nInstall complete. Have a nice day! :)\n"
