FROM php:8.2-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar os arquivos do projeto para o contêiner
COPY ../ /var/www/html

# Instalar dependências do PHP com o Composer
RUN composer install

CMD ["php-fpm"]
