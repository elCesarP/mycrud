# Usar la imagen oficial de PHP 8.2
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer con verificación de firma
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Crear un usuario no-root
RUN useradd -m -s /bin/bash appuser \
    && mkdir -p /var/www/html \
    && chown -R appuser:appuser /var/www/html

# Cambiar al usuario no-root
USER appuser

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY --chown=appuser:appuser . .

# Configurar Git para manejar "directorios dudosos" como seguros
RUN git config --global --add safe.directory /var/www/html \
    && composer config --global cache-dir /tmp/composer-cache

# Forzar limpieza del directorio vendor y reinstalar dependencias
RUN rm -rf /var/www/html/vendor \
    && composer install --no-dev --optimize-autoloader --prefer-dist

# Configurar permisos para carpetas críticas de Laravel
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto del contenedor
EXPOSE 8000

# Comando por defecto
CMD ["php-fpm"]