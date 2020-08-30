#!/bin/bash

if [ ! -f /etc/nginx/ssl/grutto-ssl-bundle.crt ]; then
    openssl genrsa -out "/etc/nginx/ssl/grutto.key" 2048
    openssl req -new -key "/etc/nginx/ssl/grutto.key" -out "/etc/nginx/ssl/grutto.csr" -subj "/CN=default/O=default/C=UK"
    openssl x509 -req -days 365 -in "/etc/nginx/ssl/grutto.csr" -signkey "/etc/nginx/ssl/grutto.key" -out "/etc/nginx/ssl/grutto-ssl-bundle.crt"
fi

nginx
