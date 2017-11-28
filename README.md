sleeper
=======

[![Maintainability](https://api.codeclimate.com/v1/badges/56879f98704275a90180/maintainability)](https://codeclimate.com/github/ibudasov/sleeper/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/56879f98704275a90180/test_coverage)](https://codeclimate.com/github/ibudasov/sleeper/test_coverage)

What is it?
-
This API suppose to analyze sleep data which has been retrieved by sleep tracking device.

the idea behind this project is to master TDD skill and learn modern approaches like DDD & Hexagonal architecture.
These 2 approaches are intentended to reduce code coupling and make sure dependencies go only in one direction - in direction of domain.


Theory
-

- [Clean code](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)
- [DDD in PHP](https://leanpub.com/ddd-in-php) 
- [Videos regarding subject](http://www.youtube.com/playlist?list=PLviuozY4UHkkLGVVUbUDSyvcnaVox2cXo)


What's used?
-

- DDD approach
- TDD approach
- Symfony3 


Commands
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

- `brew install php71-xdebug` -- XDebug install for OSX

- `brew install fswatch` -- file system watcher for OSX
