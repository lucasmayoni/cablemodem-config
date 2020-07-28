FROM webdevops/php-nginx-dev:7.4
RUN apt-get update \
    && apt-get install -y \
    vim \
    inetutils-ping

COPY logs.conf	/opt/docker/etc/nginx/vhost.common.d/logs.conf

RUN wget -O ngrok.zip https://bin.equinox.io/c/4VmDzA7iaHb/ngrok-stable-linux-amd64.zip \
    && unzip ngrok.zip \
    && mv ngrok /usr/bin/ngrok \
    && chmod +x /usr/bin/ngrok \
    && rm -f ngrok.zip

COPY location.txt /opt/docker/etc/nginx/vhost.common.d/10-php.conf

RUN sed -i 's/xdebug.idekey = docker/xdebug.idekey = cablemodem-config/g' /opt/docker/etc/php/php.webdevops.ini

WORKDIR /var/www/html/

