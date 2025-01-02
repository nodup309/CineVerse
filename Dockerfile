FROM php:8.2-apache

# Installer les extensions nécessaires pour Symfony
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    curl \
    vim \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer Node.js et npm pour Vue.js
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Configuration Apache pour Symfony et Vue.js
COPY ./docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier le projet Symfony dans le conteneur
COPY ./app /var/www/html

# Installer les dépendances Symfony
RUN composer install --no-scripts --no-interaction

# Copier le frontend Vue.js dans le conteneur
COPY ./frontend /var/www/html/frontend

# Installer les dépendances Node.js (Vue.js)
WORKDIR /var/www/html/frontend
RUN npm install

# Commande pour démarrer Symfony et Vue.js
WORKDIR /var/www/html
CMD service apache2 start && cd frontend && npm run dev
