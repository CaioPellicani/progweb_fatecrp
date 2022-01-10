FROM php:8.0-apache

ARG user_name=caio
ARG user_id=1000

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y

RUN useradd -G www-data,root -u $user_id -d /home/${user_name} ${user_name}
#RUN chown -R ${user_name}:${user_name}  /home/${user_name}  
RUN chown -R ${user_name}:${user_name} /var/www/html

WORKDIR /var/www/
USER $user_name
