FROM nginx:stable-alpine

ADD ./nginx/cert/cert.pem /etc/ssl/cert.pem
ADD ./nginx/cert/cert.key /etc/ssl/cert.key

ADD ./nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./nginx/default.conf /etc/nginx/conf.d/default.conf
ADD ./nginx/default_ssl.conf /etc/nginx/conf.d/default_ssl.conf


RUN mkdir -p /var/www/html

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN chown laravel:laravel /var/www/html