FROM php:8.2-apache

ENV DEBIAN_FRONTEND=noninteractive

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    libcurl4-openssl-dev \
    libonig-dev \
    libpq-dev \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql pdo_pgsql mbstring zip curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Activar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar proyecto al contenedor
COPY . /var/www/html/

# Asignar permisos correctos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Cambiar el archivo por defecto a login.php
RUN echo "DirectoryIndex login.php" > /etc/apache2/conf-available/override.conf \
    && a2enconf override

# ⚠️ Aquí el cambio para evitar errores por el bloque Directory
RUN bash -c 'echo "<Directory /var/www/html>\n\
Options Indexes FollowSymLinks\n\
AllowOverride All\n\
Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf'

# Establecer ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


