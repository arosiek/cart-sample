# Sample cart project

## assumptions:

- json file is used as products database
- price precision is 2 (like 10.99)

## requirements

- docker
- docker-compose

## instalation

1. `docker-compose up -d`
2. inside container `composer install` 
   or simply `docker exec -it php_sample_cart bash -c "composer install"`

## run tests:

- unit
    -  `docker exec -it php_sample_cart bash -c "vendor/bin/phpunit --configuration phpunit --testsuite unit"`
- integration
    -  `docker exec -it php_sample_cart bash -c "vendor/bin/phpunit --configuration phpunit --testsuite integration"`
- unit + integration:
    - `docker exec -it php_sample_cart bash -c "composer test"`
- static tests (`phpstan`)
    - `docker exec -it php_sample_cart bash -c "composer analyse"`
