FROM mariadb:10.2

MAINTAINER Mostafa Shamkhani <shamkhani@gmail.com>

ARG MY_CNF_FILE

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
COPY ./docker-entrypoint-initdb.d /docker-entrypoint-initdb.d

CMD ["mysqld"]

EXPOSE 3306
