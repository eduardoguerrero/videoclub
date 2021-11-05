
## Videoclub app

```
Symfony 5.3.10

PHP 7.2.34-24+ubuntu18.04.1+deb.sury.org+1

mariadb 10.2

```

***

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

5 - Execute request

Get movie by ID

```
curl "http://172.20.0.6/api/movie/2"


Response

[
  {
    "id": 2,
    "name": "Back to the future",
    "description": "Marty travels back in time using an eccentric scientist s time machine.",
    "unit_price": "3.00",
    "type": {
      "id": 2,
      "name": "Películas normales",
      "created_at": {
        "date": "2021-11-04 18:51:52.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    },
    "created_at": {
      "date": "2021-11-04 18:51:53.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
]
```

Get all movies
```

curl "http://172.20.0.6/api/movies"

Response

[
  {
    "id": 1,
    "name": "Jason Bourne",
    "description": "The CIA s most dangerous former operative is drawn out of hiding to uncover more explosive truths about his past.",
    "unit_price": "3.00",
    "type": {
      "id": 2,
      "name": "Películas normales",
      "created_at": {
        "date": "2021-11-04 18:51:52.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    },
    "created_at": {
      "date": "2021-11-04 18:51:52.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  },
  {
    "id": 2,
    "name": "Back to the future",
    "description": "Marty travels back in time using an eccentric scientist s time machine.",
    "unit_price": "3.00",
    "type": {
      "id": 2,
      "name": "Películas normales",
      "created_at": {
        "date": "2021-11-04 18:51:52.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    },
    "created_at": {
      "date": "2021-11-04 18:51:53.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  },
  {
    "id": 3,
    "name": "District 9",
    "description": "A few aliens are forced to live in pathetic conditions on Earth.",
    "unit_price": "3.00",
    "type": {
      "id": 3,
      "name": "Películas viejas",
      "created_at": {
        "date": "2021-11-04 18:51:52.000000",
        "timezone_type": 3,
        "timezone": "UTC"
      }
    },
    "created_at": {
      "date": "2021-11-04 18:51:53.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
]

```


Get all movie types
```

curl "http://172.20.0.6/api/movies/types"

Response
      
[
  {
    "id": 1,
    "name": "Nuevos lanzamientos",
    "created_at": {
      "date": "2021-11-04 18:51:52.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  },
  {
    "id": 2,
    "name": "Películas normales",
    "created_at": {
      "date": "2021-11-04 18:51:52.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  },
  {
    "id": 3,
    "name": "Películas viejas",
    "created_at": {
      "date": "2021-11-04 18:51:52.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
]
    
```

Get movies per type
```

curl "http://172.20.0.6/api/movie/type/2"

Response
  
[
  {
    "movieId": 1,
    "name": "Jason Bourne",
    "description": "The CIA s most dangerous former operative is drawn out of hiding to uncover more explosive truths about his past.",
    "unitPrice": "3.00",
    "isActive": true,
    "createdAt": {
      "date": "2021-11-04 18:51:52.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "type": "Películas normales"
  },
  {
    "movieId": 2,
    "name": "Back to the future",
    "description": "Marty travels back in time using an eccentric scientist s time machine.",
    "unitPrice": "3.00",
    "isActive": true,
    "createdAt": {
      "date": "2021-11-04 18:51:53.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "type": "Películas normales"
  }
]
    
```


Calculate rent movie
```

curl --location --request POST 'http://172.20.0.6/api/movie/rent' \
    --header 'Content-Type: application/json' \
    --data-raw '[
    {
    "movie_id": 1,
    "start_date": "2021-11-01",
    "end_date": "2021-11-03"
    },
    {
    "movie_id": 3,
    "start_date": "2021-11-01",
    "end_date": "2021-11-10"
    }
    ]'

Response

[
    {
        "name": "Jason Bourne",
        "type": "Películas normales",
        "costs": {
            "price": 3,
            "extra_cost": 0,
            "total": 3
        }
    },
    {
        "name": "District 9",
        "type": "Películas viejas",
        "costs": {
            "price": 3,
            "extra_cost": 12,
            "total": 15
        }
    }
]

```


Calculate movie points

```
curl --location --request POST 'http://172.20.0.6/api/movie/points' \
--header 'Content-Type: application/json' \
--data-raw '[
    {
      "movie_id": 1
    },
    {
      "movie_id": 3
    }
]'


Response

{
  "items": [
    {
      "movie_id": 1,
      "points": 1
    },
    {
      "movie_id": 2,
      "points": 1
    }
  ],
  "total_points": 2
}

```

## Run tests

```

./vendor/phpunit/phpunit/phpunit 

```
