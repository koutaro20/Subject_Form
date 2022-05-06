FROM mysql:8.0

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN apt-get update \
    apt-get install default-mysql-client \
    chmod 644 /etc/mysql/conf.d/my.cnf
CMD ["mysqld"]