# Database Backup Service Dayliy

Use email attachments to back up the database to the mailbox every day, support MySQL, PostgreSQL.

It also supports backup to S3, Dropbox, FTP, SFTP, you can get more information from [Database Backup Manager](https://github.com/backup-manager/backup-manager).


# 每日数据库备份服务

每日使用邮件附件的方式将数据库备份到指定邮箱，支持 MySQL、PostgreSQL。

实际上也支持备份到 S3、Dropbox、FTP、SFTP，你可以从 [Database Backup Manager](https://github.com/backup-manager/backup-manager) 获得更多信息。


# Usage

## MySQL / MariaDB

```yaml
version: '3'

services:
  # ...
  # ...

  mysql:
    image: mysql:8
    container_name: mysql
    restart: always
    environment:
      MYSQL_DATABASE: mysql_db
      MYSQL_USER: mysql_user
      MYSQL_PASSWORD: j6&GTA5ftYB47x8d
      TZ: Asia/Shanghai
    volumes:
      - ./mysql/data:/var/lib/mysql

  php:
    image: mrgeneralgoo/laravel-cron:latest
    container_name: cron_backup
    depends_on:
      - mysql
    environment:
      # env config
      TZ: Asia/Shanghai
      APP_KEY: nXsIUyUtJsjoPg6gHKRxFhlW7oHFhIiy
      # db config
      DB_TYPE: pgsql
      DB_HOST: mysql
      DB_PORT: 5432
      DB_DATABASE: mysql_db
      DB_USERNAME: mysql_user
      DB_PASSWORD: mysql_password
      # mail config
      MAIL_DRIVER: smtp
      MAIL_HOST: smtp_server.example.org
      MAIL_PORT: 465
      MAIL_ENCRYPTION: ssl
      MAIL_USERNAME: sender_name
      MAIL_PASSWORD: sender_password
      MAIL_FROM_ADDRESS: sender_mail_addr@example.org
      MAIL_FROM_NAME: Database Backup Notice
      MAIL_RECIPIENT_ADDRESS: recipient_mail_addr@example.org
    restart: always
```

## PostgreSQL

```yaml
version: '3'

services:
  # ...
  # ...
  
  postgres:
    image: postgres:13-alpine
    container_name: postgres
    restart: always
    environment:
	    POSTGRES_DB: postgres_db
      POSTGRES_USER: postgres_user
      POSTGRES_PASSWORD: postgres_password
      TZ: Asia/Shanghai
    volumes:
      - ./postgresql/data:/var/lib/postgresql/data

  php:
    image: mrgeneralgoo/laravel-cron:latest
    container_name: cron_backup
    depends_on:
      - postgres
    environment:
      # env config
      TZ: Asia/Shanghai
      APP_KEY: nXsIUyUtJsjoPg6gHKRxFhlW7oHFhIiy
      # db config
      DB_TYPE: pgsql
      DB_HOST: postgres
      DB_PORT: 5432
      DB_DATABASE: postgres_db
      DB_USERNAME: postgres_user
      DB_PASSWORD: postgres_password
      # mail config
      MAIL_DRIVER: smtp
      MAIL_HOST: smtp_server.example.org
      MAIL_PORT: 465
      MAIL_ENCRYPTION: ssl
      MAIL_USERNAME: sender_name
      MAIL_PASSWORD: sender_password
      MAIL_FROM_ADDRESS: sender_mail_addr@example.org
      MAIL_FROM_NAME: Database Backup Notice
      MAIL_RECIPIENT_ADDRESS: recipient_mail_addr@example.org
    restart: always
```