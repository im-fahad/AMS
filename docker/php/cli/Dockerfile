FROM php:7.4-cli-alpine

# Add Repositories
RUN rm -f /etc/apk/repositories &&\
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.12/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.12/community" >> /etc/apk/repositories

# Add Build Dependencies
RUN apk update && apk add --no-cache \
    libzip-dev \
    libmcrypt-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    bzip2-dev \
    zip \
    libzip-dev \
    bash \
    supervisor \
    icu-dev \
    jpegoptim \
    pngquant \
    optipng \
    freetype-dev

# Configure & Install Extension
RUN docker-php-ext-configure \
    opcache --enable-opcache &&\
    docker-php-ext-configure gd && \
    docker-php-ext-configure zip && \
    docker-php-ext-install \
    opcache \
    mysqli \
    pdo \
    pdo_mysql \
    json \
    intl \
    gd \
    xml \
    bz2 \
    bcmath \
    zip


## Crontab
RUN apk update
RUN touch /var/log/cron.log
COPY schedules/cron /etc/cron.d/cron
RUN chmod -R 755 /etc/cron.d/cron
RUN /usr/bin/crontab /etc/cron.d/cron
#CMD cron -f

## Supervisor
#COPY supervisord.conf /etc/supervisord.conf
COPY worker.conf /etc/supervisor/conf.d/worker.conf
COPY supervisord.conf /etc/supervisord.conf
RUN chmod -R 644 /etc/supervisor/conf.d/worker.conf
RUN chmod -R 644 /etc/supervisord.conf
RUN touch /tmp/supervisor.sock
RUN chmod 777 /tmp/supervisor.sock
# Remove Build Dependencies
#RUN apk del -f .build-deps

# Setup Working Dir
WORKDIR /var/www/core

#RUN curl -sS https://getcomposer.org/installer | \
#php -- --install-dir=/usr/bin/ --filename=composer
#
#ENV COMPOSER_ALLOW_SUPERUSER=1

#CMD ["php", "-S", "0.0.0.0:8000"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
#ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]