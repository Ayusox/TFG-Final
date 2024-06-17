FROM php:7.4-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Reiniciar Apache
RUN service apache2 restart
