#---------------------------------------------------
# FINAL IMAGE
#---------------------------------------------------

# Image
FROM php:8.1-fpm-alpine

# Variables
ENV DOCUMENT_ROOT /var/www/localhost/htdocs
ENV TZ=America/Sao_Paulo
ENV XDEBUG_MODE=debug
ENV XDEBUG_CLIENT_HOST=host.docker.internal
ENV XDEBUG_CLIENT_PORT=9003

# Install dependencies
RUN apk add --no-cache \
    bash \
    nginx \
    unzip \
    git \
    pkgconfig \
    icu-dev \
    curl-dev \
    openssl-dev \
    libxml2-dev \
    libzip-dev \
    oniguruma-dev \
    linux-headers \
    readline-dev \
    libxslt-dev \
    libmemcached-dev \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    make \
    musl-dev \
    zlib-dev \
    libc-dev \
    gcc \
    g++ \
    autoconf

RUN pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install -j "$(nproc)" mysqli pdo_mysql intl zip xsl soap \
    && docker-php-source delete \
    && apk del --no-cache \
    perl \
    dpkg-dev \
    dpkg \
    file \
    pkgconf \
    re2c


RUN apk del make musl-dev libc-dev gcc g++ autoconf bash

# Tuning OS
RUN echo 'net.ipv4.ip_local_port_range = 12000 65535' >> /etc/sysctl.conf
RUN echo 'fs.file-max = 1048576' >> /etc/sysctl.conf
RUN mkdir /etc/security/
RUN echo '*                soft    nofile          1048576' >> /etc/security/limits.conf
RUN echo '*                hard    nofile          1048576' >> /etc/security/limits.conf
RUN echo 'root             soft    nofile          1048576' >> /etc/security/limits.conf
RUN echo 'root             hard    nofile          1048576' >> /etc/security/limits.conf

# Set Timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Workdir
WORKDIR $DOCUMENT_ROOT

# Remove NGINX old
RUN rm -f /etc/nginx/conf.d/*

# Copy app and configs
COPY . $DOCUMENT_ROOT
COPY .setup/build/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .setup/build/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY .setup/build/php/php-fpm-www.conf /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Logs to stdout
RUN ln -sf /dev/stdout /var/log/nginx/access.log && ln -sf /dev/stderr /var/log/nginx/error.log

# Expose port
EXPOSE 80

# Start APP
CMD ["nginx", "-g", "daemon off;"]
RUN chmod +x .setup/build/scripts/entrypoint.sh
ENTRYPOINT [".setup/build/scripts/entrypoint.sh"]
