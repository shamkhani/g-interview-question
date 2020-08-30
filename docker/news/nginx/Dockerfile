FROM nginx:1.15-alpine

MAINTAINER Mostafa Shamkhani <shamkhani@gmail.com>

COPY nginx.conf /etc/nginx/
COPY sites/news_monolothic.conf /etc/nginx/sites-available/

ARG PHP_UPSTREAM_SERVICE=news_fpm
ARG PHP_UPSTREAM_PORT=9000

# Install necessary packages
RUN apk update \
    && apk upgrade \
    && apk add --no-cache bash tzdata \
    && adduser -D -H -u 1000 -s /bin/bash www-data

ARG PHP_UPSTREAM_CONTAINER=news_fpm
ARG PHP_UPSTREAM_PORT=9000

# Set timezon to Tehran
ENV TZ Asia/Tehran

# Set upstream conf and remove the default conf
RUN echo "upstream php-upstream { server ${PHP_UPSTREAM_CONTAINER}:${PHP_UPSTREAM_PORT}; }" >> /etc/nginx/conf.d/upstream.conf

RUN rm /etc/nginx/conf.d/default.conf

CMD ["nginx"]

EXPOSE 443 80