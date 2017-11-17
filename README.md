sleeper
=======

[![Maintainability](https://api.codeclimate.com/v1/badges/56879f98704275a90180/maintainability)](https://codeclimate.com/github/ibudasov/sleeper/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/56879f98704275a90180/test_coverage)](https://codeclimate.com/github/ibudasov/sleeper/test_coverage)

What is it?
-
This API suppose to analyze sleep data which has been retrieved by sleep tracking device


What's used?
-

- DDD approach
- TDD approach
- Symfony3 


Commands:
-

- `composer install` -- install the API

- `bin/console server:start` -- start the server

- `vendor/bin/phpunit` -- run the tests

- `fswatch -o ./tests -o ./src | xargs -n1 -I{} ./vendor/bin/phpuni` -- watch unit tests
   
- `src/SleeperBundle/Resources/source.csv` -- source data
