FROM php:8.1-fpm

# Install additional tools
RUN rm /etc/apt/preferences.d/no-debian-php && \
    apt-get update && apt-get install -y \
    git zlib1g-dev libicu-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Setup workdir and user
WORKDIR /var/www/app
RUN chown -R www-data:www-data /var/www

# Add access for default system user, so there's no issues with file permissions
ARG PUID
RUN if [ "$PUID" ]; then usermod -u $PUID www-data; fi
USER www-data
