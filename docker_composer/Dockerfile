FROM composer:1.6

RUN apk add --no-cache $PHPIZE_DEPS \
	&& pecl install xdebug-2.6.0 \
	&& docker-php-ext-enable xdebug