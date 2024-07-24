# Sample cart project

## sample usage
```
<?php

    $basket = (new BasketFactory())->createRegularBasket();
    $basket->add('G01');
    $basket->add('R01');
    $basket->add('R01');
    $basket->add('R01');
    
    $total = $basket->total();
```

## assumptions:

- json file is used as products database
- price precision is 2 (like 10.99)
- I'm skipping `$` sign in prices anywhere (assuming it is only task description)
- not integrating phpcs+fixer or phpmd since it was not requirement (like phpstan)
- default phpstorm configuration was used for coding format
- code coverage was not any kind of goal instead of meaningful tests and TDD

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
