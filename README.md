# Sample cart project

## requirements

- docker
- docker-compose

## instalation

1. `docker-compose up -d`
2. inside container `composer install` 
   or simply `docker exec -it php_sample_cart bash -c "composer install"`

## run tests:

- unit / integration:
    - inside container: `composer test` or simply `docker exec -it php_sample_cart bash -c "composer test"`
- static tests (phpstan)
    - inside container: `composer analyse` or simply `docker exec -it php_sample_cart bash -c "composer analyse"`

## assumptions:

- json file is used as products database
-