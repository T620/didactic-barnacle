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

printf "\nBuilding containers...\n"
docker-compose build

printf "\nStarting containers...\n"
docker-compose up -d
docker-compose ps

printf "\nInstall complete. Have a nice day! :)\n"
