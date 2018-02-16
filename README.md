[sleeper](https://sleeper-prod.herokuapp.com/)
=======

[![CircleCI](https://circleci.com/gh/ibudasov/sleeper.svg?style=svg)](https://circleci.com/gh/ibudasov/sleeper)
[![Maintainability](https://api.codeclimate.com/v1/badges/56879f98704275a90180/maintainability)](https://codeclimate.com/github/ibudasov/sleeper/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/56879f98704275a90180/test_coverage)](https://codeclimate.com/github/ibudasov/sleeper/test_coverage)

What is it?
-----------

This API suppose to analyse sleep data and provide some analytics regarding it.

The idea behind this project is to master TDD skill and learn modern approaches like DDD & Hexagonal architecture.
These 2 approaches are intended to reduce code coupling and make sure dependencies go only in one direction - in direction of domain.

Hexagonal style dependencies explanation
----------------------------------------

![Dependencies](src/SleeperBundle/Resources/dependencies.png)


Earned experience
-----------------

Application
- 👌 layered architecture ([DDD](https://leanpub.com/ddd-in-php) or [hexagonal](http://www.youtube.com/playlist?list=PLviuozY4UHkkLGVVUbUDSyvcnaVox2cXo))
- 👌 setting up whole project from bare framework according to [Clean code](https://www.amazon.com/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)
- 👌 Dependency Inversion principle
- 👌 TDD approach -- writing tests first and then production code. When I installed test coverage tool, I found out that all domain and application are covered with tests, with no additional effort
- 👌 code structures like Value Objects, Models, Services, and where/when to use them
- 👌 using Assertions in codebase to assert use scenarios
- 👌 domain services are operations on domain building blocks
- lightweight bus (?)
- CQRS
- FOS REST bundle
- get rid of namespaces like `.../ValueObject` and etc. According to the book, namespaces should reflect domain, not building blocks

Infrastructure  
- 👌 CI with CircleCI -- it runs my tests and shows nice little badge on main page of repo
- 👌 CD with Heroku
- 👌 SQLite - quite nice for development, just perfect for tests
- 👌 nice composer aliases for commands, so I can run all the tests or install the whole project with one simple command
- 👌 setting up test coverage tool (nothing special, just using PHPUnit + XDebug)
- 👌 setting up contract tests with test database and [fixtures](https://github.com/hautelook/AliceBundle)
- 👌 Docker (Compose) to wrap codebase in the container and database in separate container
- Kubernetes to be able to scale
- Swagger docs

Enterprise application patterns
- https://www.martinfowler.com/eaaCatalog/domainModel.html
- https://www.martinfowler.com/eaaCatalog/serviceLayer.html
- https://www.martinfowler.com/eaaCatalog/repository.html
- https://www.martinfowler.com/eaaCatalog/dataTransferObject.html
- https://www.martinfowler.com/eaaCatalog/gateway.html  
- https://www.martinfowler.com/eaaCatalog/mapper.html
- https://www.martinfowler.com/eaaCatalog/valueObject.html
- https://www.martinfowler.com/eaaCatalog/plugin.html

Commands
--------

kubernetes
- `composer kube:run` -- installs and runs application and ES
- `composer kube:stop` -- stops and destroys everything

docker-compose
- `composer compose:install` -- install the API and ES (will be running at the end)
- `composer compose:run` -- run the API and ES
- `composer compose:stop` -- stop the API and ES
- `composer compose:destroy` -- destroy the API and ES

docker
- `composer docker:install` -- install the API
- `composer docker:run` -- start the server
- `composer docker:test` -- run all the tests
- `composer docker:test:unit` -- run unit tests (fast)
- `composer docker:test:contract` -- run contact test based on Symfony crawler (slow)

without docker, with proper local env
- `composer install` -- install the API
- `composer run` -- start the server
- `composer stop` -- stop the server
- `composer test` -- run all the tests
- `composer test:unit` -- run unit tests (fast)
- `composer test:contract` -- run contact test based on Symfony crawler (slow)
- `composer test:coverage` -- test coverage (requires XDebug installed)
- `composer test:watch` -- watch unit tests (sorry, OSX + fswatch only)

Prerequisites
-------------

- `apt install php7.1-xdebug` -- XDebug needed for test coverage, that's how to install it for Ubuntu
- `brew install php71-xdebug` -- XDebug install for OSX
- `brew install fswatch` -- file system watcher for OSX
- Docker
- Docker Compose

Docker things
-------------

- `docker build -t sleeper .` -- building image
- `docker run -p 8000:8000 -it --rm sleeper` -- run the app
- `docker exec 5e6097d43c7d curl localhost:8000` -- checks if server is running inside container
- `docker stop $(docker ps -a -q) && docker rmi  $(docker images -q) -f` -- stop and remove everything related to docker, not only this project, but globally
