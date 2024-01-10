FROM public.ecr.aws/docker/library/php:8.0.27-fpm-alpine3.16
#FROM public.ecr.aws/docker/library/php:8.0.27-cli-alpine3.16

ENV XDEBUG_MODE=coverage
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apk add --no-cache --update $PHPIZE_DEPS bash git unzip msmtp jpegoptim \
    imagemagick-dev curl-dev libxml2-dev aspell-dev libxslt-dev libzip-dev zlib-dev gmp-dev libmemcached-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev imagemagick libpng libjpeg-turbo libjpeg-turbo-utils \
    openssh-client npm yarn ruby ruby-dev php8-pecl-xdebug linux-headers \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && npm install -g grunt-cli \
    && gem install --no-document compass \
    && CFLAGS="-I/usr/src/php" docker-php-ext-install bcmath curl dom gd opcache pcntl pdo pdo_mysql phar posix \
      pspell simplexml soap sockets xml xmlreader xmlwriter xsl zip gmp \
    && pecl install -o -f xdebug && docker-php-ext-enable xdebug \
    && pecl install -o -f igbinary && docker-php-ext-enable igbinary \
    && pecl install -o -f memcached && docker-php-ext-enable memcached \
    && git clone https://github.com/Imagick/imagick && cd imagick && \
      phpize && ./configure && make && make install && \
      cd ../ && rm -rf imagick && docker-php-ext-enable imagick \
    && git clone "https://github.com/tideways/php-xhprof-extension.git" && cd php-xhprof-extension && \
      phpize && ./configure && make && make install && docker-php-ext-enable tideways_xhprof

RUN echo 'xdebug.mode=coverage' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
 && echo 'memory_limit=-1' >>  /usr/local/etc/php/conf.d/docker-fpm.ini \
 && mv /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/20-docker-php-ext-opcache.ini \
 && mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/99-docker-php-ext-xdebug.ini
