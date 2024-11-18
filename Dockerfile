FROM php:8.3-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    sqlite3 \
    libsqlite3-dev \
    pkg-config \
    && docker-php-ext-install pdo pdo_sqlite

# Copiar el archivo de configuración de Nginx
COPY default /etc/nginx/sites-available/default

# Copiar los archivos del proyecto
COPY . /var/www/html

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto 8081
EXPOSE 8081

# Iniciar el servicio PHP y Nginx
CMD service nginx start && php-fpm

