# Wähle ein Basis-Image
FROM ubuntu:22.04

# Nicht interaktive Installation konfigurieren
ARG DEBIAN_FRONTEND=noninteractive

# Paketquellen aktualisieren und grundlegende Tools installieren
RUN apt-get update && apt-get install -y \
    software-properties-common \
    curl \
    zip \
    unzip \
    git

# PHP 8.2 und erforderliche PHP-Extensions installieren
RUN add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.2-fpm php8.2-cli php8.2-mbstring php8.2-xml php8.2-curl php8.2-mysql php8.2-gd

# Composer installieren
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Arbeitsverzeichnis setzen
WORKDIR /var/www

# Laravel-Anwendung kopieren
COPY . /var/www

# Abhängigkeiten installieren
RUN composer install

# Berechtigungen setzen
RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www/storage && \
    chmod -R 755 /var/www/bootstrap/cache

# Port freigeben
EXPOSE 9000

# Laravel-Artisan-Serve-Befehl zum Starten der Anwendung verwenden
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]