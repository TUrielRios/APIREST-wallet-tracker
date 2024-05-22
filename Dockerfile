# Usar la imagen oficial de PHP
FROM php:7.4-apache

# Copiar los archivos de tu aplicación al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Exponer el puerto 80
EXPOSE 80
