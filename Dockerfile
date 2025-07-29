FROM php:8.1-apache

COPY . /var/www/PHP/

RUN chown -R www-data:www-data /var/www/html

# Hacer que login.php sea la página por defecto
RUN echo "DirectoryIndex login.php" > /etc/apache2/conf-available/override.conf \
    && a2enconf override

# Activar que Apache respete el override
RUN sed -i 's|/var/www/html|/var/www/html\n\t<Directory "/var/www/html">\n\t\tAllowOverride All\n\t</Directory>|' /etc/apache2/sites-available/000-default.conf
