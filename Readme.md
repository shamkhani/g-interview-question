<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo"></a>
</p>

<h3 align="center">Grutto Interview</h3>

---

<p align="center"> Task 1, News Panel
    <br> 
</p>

## 📝 Table of Contents

- [Solutions](#sol)
- [Getting Started](#getting_started)
- [Deployment](#deployment)


## Introduction to Task 1<a name = "sol"></a>

I wrote task 1 in two solutions that I will describe one by one below:

- [Monolothic Project]
- [Laravel Package]
- [Microservices]

## Monolithic Project Solution
In this way, I separate Logics and Database from Controller Via n-tire application layered.
### Structre 
    - View
    - Controller
    - Service
    - Repository
    - Model

### View: 
In the view layer, I put all designs on it and we have the only view.
### Controler:
 In Controller, I just handed Validations and pass data to the service layer
### Service: 
First of all, in the Service layer I see all news entities such as Category, Tags, and New item as a Domain (News Domain) so I put all logics about theses entities in news service.
The service layer contains application logics
### Repository:
In this layer we have ways to fetch data from models

### Model:
Data structure and Relationships

## Laravel Package - Monolithic Project Solution
As mentioned in Task 1, which our code is contains a large codebase, I would prefer to use a package to separate business logic for each module that we need. 

## Microservies Solutions
Moreover, we can use Microservices Architecture to decouple modules into services that each service can have their database and logics and setup an API Gateway and Auth service to handel request before sent to other services.

## 🏁 Getting Started <a name = "getting_started"></a>

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See [deployment](#deployment) for notes on how to deploy the project on a live system.

## Prerequisites
-   Webserver solution
-   Docker base solution

### Webserver solution
- Linux / Mac / Windows
- MariaDB
- Php-fpm
- Nginx 
or
- just Install LEMP for Linux, Xammp for Windows
### Docker base solution
- docker
- docker-compose
- composer

## Installing
First of all, you must run docker service and execute docker-compose

- For web server solution you need to install LEMP,XAMPP, LAMP, etc please see <a href="https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04">How Install LEMP Stack</a>

- For Docker you must install Docker and Docker-compose <a href="https://cwiki.apache.org/confluence/pages/viewpage.action?pageId=94798094">Install Docker and Docker Compose</a>


## 🚀 Deployment <a name = "deployment"></a>

- Deploy with LEMP, XAMPP, LAMP, etc please 
    - Copy news_monolothic folders to /var/www/
    - Config Nginx host to serve the project
    - Restart Nginx and PHP-Fpm
    - Open project on browser

- Deploy with Docker
    At first, you must navigate to docker folder on project directory, then run this command:
    ``` 
        docker-compose up -d
    ```
    After run docker-compose, it will install all necessary images, requirements on your machine
    I put composer install and PHP artisan migrate on docker-compose.yml to setup the Laravel project, so after running your docker-compose up, my custom command will be executed. please wait until the composer installs complete and then PHP migration runs as well as finishes successfully.

    For manual installation Laravel composer dependency, you can run that command in docker terminal
    ```
    docker-compose exec news_fpm bash
    ```
    After open news_fpm terminal
    ```
    cd /var/www/news_monolothic
    composer install
    php artisan migrate
    php artisan storage:link
    ```

If all below process finished without exit, you can see the result on your browser with address http://localhost:8081
Also, you can deploy the project on Xammp, Wamp, or Lamp as well


