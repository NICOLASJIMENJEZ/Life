# Usa una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copia todos los archivos al directorio del servidor web en el contenedor
COPY . /var/www/html/

# Habilita el módulo de reescritura (opcional, útil para URLs amigables)
RUN a2enmod rewrite

# Establece permisos (opcional pero recomendado)
RUN chown -R www-data:www-data /var/www/html

# Expón el puerto 80
EXPOSE 80
