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

- `composer run` -- start the server

- `composer stop` -- stop the server

- `composer test` -- run the tests

- `composer test:coverage` -- test coverage (requires XDebug installed)

- `composer test:watch` -- watch unit tests (sorry, OSX + fswatch only)


Prerequisites
-

- `apt install php7.1-xdebug` -- XDebug needed for test coverage, that's how to install it for Ubuntu
   
- `src/SleeperBundle/Resources/source.csv` -- source data
