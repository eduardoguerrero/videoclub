
## Videoclub app

```
Symfony 5.3.10

PHP 7.2.34-24+ubuntu18.04.1+deb.sury.org+1

mariadb 10.2

```

##  Setup Videoclub app

##### 


1 - Change to docker folder in project structure:

```
cd /var/www/html/videoclub/docker
```

2 - Now, build and run your app with docker:
```
docker-compose up
```

3 - Connect to MariaDB

```
docker exec -it videoclub_mariadb bash -l

mysql -uroot -proot

And execute: create database if not exists videoclub;
```

4 - Create tables

```
php bin/console doctrine:migration:execute  --up 'DoctrineMigrations\Version20211103060315'

To revert the migration you can use --down 'DoctrineMigrations\Version20211103060315'

```














##### Web server

```
User: dev
 
docker exec -it -u dev videoclub_php bash
```


##### phpMyAdmin

```
http://localhost:8080/

user: root

password: root
```



