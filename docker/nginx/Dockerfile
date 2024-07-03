FROM nginx:1.25.1 AS base

RUN apt update
RUN apt-get install vim iputils-ping -y

RUN mkdir -p /var/cache/nginx/client_temp && \
    chown -R www-data:www-data /var/cache/nginx

RUN touch /var/run/nginx.pid && \
    chown www-data:www-data /var/run/nginx.pid

COPY ./public/index.php /usr/share/nginx/html/index.php

USER www-data

WORKDIR /var/www

FROM base as development
COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/
COPY ./certs /usr/share/certs/
COPY --chown=www-data:www-data public /var/www/public

WORKDIR /var/www
EXPOSE 80
EXPOSE 443

FROM base as production
# copy the prod config when in prod
# ssl certs are handled automatically by traefik
COPY ./docker/nginx/nginx.prod.conf /etc/nginx/conf.d/default.conf
COPY --chown=www-data:www-data public /var/www/public

WORKDIR /var/www

EXPOSE 80
EXPOSE 443
