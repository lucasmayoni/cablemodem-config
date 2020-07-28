# cablemodem-config
### Requerimientos

- PHP v7.x fpm. Mbstring, XML
- Nginx
- MySQL
- Composer

### Configuracion NGINX (opcional)
```
server{
	listen 80;
	server_name local.cmconfig.com;
	return 301 https://$server_name$request_uri;
}
server {
    listen 443 ssl;
    server_name local.cmconfig.com;

    root /home/lucas/dev/cablemodem-config/public;
    index index.php index.html index.htm;
	
	ssl on;
	ssl_certificate /etc/nginx/ssl/nginx.crt;
	ssl_certificate_key /etc/nginx/ssl/nginx.key;

	ssl_session_timeout 5m;
	ssl_protocols SSLv3 TLSv1 TLSv1.1 TLSv1.2;
    	ssl_ciphers "HIGH:!aNULL:!MD5 or HIGH:!aNULL:!MD5:!3DES";
    	ssl_prefer_server_ciphers on;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
	try_files $uri /indexp.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.x-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```
### Configuracion laravel
```
- git clone git@github.com:lucasmayoni/cablemodem-config.git 
- mv .env.example .env
- composer install
- php artisan key:generate
- php artisan:migrate
- php artisan db:seed
```

### Configuracion Docker (Leer)
https://runnable.com/docker/docker-compose-networking

### Configuracion Docker Compose 
```
- CM_CONFIG_IP=172.18.0.165
- CM_CONFIG_CODE_PATH=/home/lucas/code/cablemodem-config
- NETWORK_SUBNET=172.18.0.0/16
- MYSQL_IP=172.18.0.200
```
```
version: "3"

# NETWORK #
networks:
  default:
    driver: bridge
    ipam:
      driver: default
      config:
        - subnet: ${NETWORK_SUBNET}

# VOLUMES #
volumes:
  mysql:
    driver: local
  composer-cache-7.4:
    driver: local 
# ----------------------------- #    

services:
  # MYSQL SERVER#
  mysql:
    image: mysql:5.6
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: secret
    networks:
      default:
        ipv4_address: ${MYSQL_IP}
    ports:
      - 3306:3306
    volumes:
      - mysql:/var/lib/mysql
  adminer:
    image: adminer
    restart: always
    ports:
      - 8080:8080
cablemodem-config:
    image: lmayoni/cablemodem-config
    restart: always
    networks:
      default:
        ipv4_address: ${CM_CONFIG_IP}
        aliases:
          - local.cmconfig.com
    expose:
      - 80
      - 443
    environment:
      - WEB_DOCUMENT_ROOT=/var/www/html/public
      - WEB_ALIAS_DOMAIN=local.cmconfig.com
      - XDEBUG_REMOTE_AUTOSTART=1
      - XDEBUG_REMOTE_CONNECT_BACK=0
      - XDEBUG_REMOTE_HOST=172.18.0.1
      - PHP_IDE_CONFIG=serverName=cablemodem-config
    volumes:
      - ${CM_CONFIG_CODE_PATH}:/var/www/html/
      - ./certificates/:/opt/docker/etc/nginx/ssl/
      - composer-cache-7.4:/root/.composer/
```

### Endpoints

```
curl 'http://local.cmconfig.com/api/v1/modems?model=&page=1' \
  -H 'Connection: keep-alive' \
  -H 'Accept: application/json, text/plain, */*' \
  -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36' \
  -H 'Origin: http://localhost:8081' \
  -H 'Referer: http://localhost:8081/' \
  -H 'Accept-Language: es-US,es-419;q=0.9,es;q=0.8' \
  --compressed \
  --insecure
```
Devuelve el listado de cablemodems cuyo "model" no figura en el archivo models.json
El archivo original (y luego editado) se encuentra en /storage

```
curl 'http://local.cmconfig.com/api/v1/modems' \
  -H 'Connection: keep-alive' \
  -H 'Accept: application/json, text/plain, */*' \
  -H 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36' \
  -H 'Content-Type: application/json;charset=UTF-8' \
  -H 'Origin: http://localhost:8081' \
  -H 'Referer: http://localhost:8081/' \
  -H 'Accept-Language: es-US,es-419;q=0.9,es;q=0.8' \
  --data-binary '{"name":"SB5102","vendor":"Motorola Corporation","version":"V1"}' \
  --compressed \
  --insecure
```
Agrega el cablemodems al archivo models.json
