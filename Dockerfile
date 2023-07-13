FROM php:8.2-apache

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование и настройка приложения
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Установка зависимостей Composer
RUN composer install

# Запуск Apache сервера
CMD apache2-foreground
