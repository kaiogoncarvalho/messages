# Messages

This API is responsible for management of messages. 

## Install

This System uses Docker, so it is necessary Docker 
and Docker Compose installed to run this project, but you can configure nginx (or apache), php and mysql.

For install is necessary follow this steps:

**Install using Docker**

* Acess the directory of project
* give permissions for logs:
    * `sudo chmod 777 -R storage`
* run this command to install libraries
    * docker run --rm --interactive --tty \     
         --volume $PWD:/app \         
         --user $(id -u):$(id -g) \         
         composer install --ignore-platform-reqs --no-scripts
* run this commands for install and start docker
    * `docker-compose build`
    * `docker-compose up -d`
* run this command for create tables
    * `docker-compose exec php php artisan migrate`




**Install without Docker**
* Configure nginx (or apache), php and mysql;
* Acess the directory of project
* give permissions for logs:
    * `sudo chmod 777 -R storage`
* run this command to install libraries
    *  `composer install`
* run this command to create tables
    * `php artisan migrate`


## Tests
For run tests follow this steps in directory of project:
* run this command to create database test:
    * `docker-compose exec php php artisan create-database:test`
* run this command to run acceptance tests:    
    * `docker-compose exec php composer tests`

If you don't user Docker to Install use this commands in directory of project:
* run this command to create database test:
    * `php artisan create-database:test`
* run this command to run acceptance tests:    
    * `php composer tests`


## Usage

**Important: The Tokens expires in two hours, you need generate new token in endpoints of login**

Access this URL for docs of endpoints (this URL is only if you use Docker to install project):
 
 * **URL:** http://localhost:7080
 
Access this URL for API of endpoints ((this URL is only if you use Docker to install project):
  
  * **URL:** http://localhost:8080

_if you don't use Docker to install system you need configure the URL;_  

_if you don't use Docker to install, follow this steps to generate documentation:_

* _access this site https://editor.swagger.io/_
* _select File -> Import File
    * _select this file (directory of project)/docs/swagger.yaml__

