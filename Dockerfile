FROM ubuntu:latest

RUN apt update && \
    apt install -y nginx php-fpm php-sqlite3

COPY . /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD service php8.3-fpm start && nginx -g "daemon off;"
