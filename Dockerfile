FROM php:7.4-apache

# Instalar la extensión mysqli
RUN docker-php-ext-install mysqli

# Copiar los archivos de tu aplicación al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html/

# Exponer el puerto 80
EXPOSE 80
