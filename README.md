# SYMFONY DDD REST APP EXAMPLE

## Description

## Technical Requirements
* PHP 7.4;
* MySQL 5.7;
* [Symfony 5.2 application requirements](https://symfony.com/doc/5.2/setup.html#technical-requirements)

## Installation
1. Clone the project to download its contents.
    ````
     git clone https://github.com/CertainGitHubUser/symfony-ddd-rest-app-example.git
    ````
2. Adjust .env file.<br>
3. Install project's dependencies into vendor/.
    ````
    composer install
    ````
4. Run database migrations.
    ````
   bin/console doctrine:migrations:migrate
   ````
## Usage
Check Postman documentation ````documentation/postman````.

Run symfony server ```symfony server:start``` 
## TODO
- [ ] Improve exceptions handling