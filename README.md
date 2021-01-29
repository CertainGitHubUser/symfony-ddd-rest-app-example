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
Create user````bin/console app:user:add userName```` 
Run symfony server ```symfony server:start``` 
You can check test examples in this commit https://github.com/CertainGitHubUser/symfony-ddd-rest-app-example/commit/61245f5b65f9b97126a2060e4526648e9f0185f8
## TODO
- [ ] Improve exceptions handling
