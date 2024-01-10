FROM 290707654612.dkr.ecr.eu-central-1.amazonaws.com/gitlab-engine-pipeline-image:codebase

ENV COMPOSER_ALLOW_XDEBUG=1

WORKDIR /var/www

ADD . .

RUN echo 'memory_limit = -1' >> .docker/app/php.ini

RUN cat .docker/app/php.ini \
 && php --ini \
 && ls -la . \
 && composer update --prefer-dist --no-scripts \
 && ls -la . && ls -la vendor/bin

USER root
WORKDIR /var/www/theme/site

RUN npm install \
 && grunt

USER 1000
WORKDIR /var/www

RUN ls ./ -la