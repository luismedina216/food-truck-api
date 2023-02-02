# Food Web App

### Prerequisites

* docker
    * It's needed to install [docker client](https://docs.docker.com/get-docker/)
    * It's needed to install [docker compose](https://docs.docker.com/compose/install/)

## Installation

Once you have docker installed, it is necessary to execute the following commands in the project path

    cp .env.example .env

    docker compose up -d

### My app is already running?

Note: We must wait until the dependencies are already installed and the server is up and running.

To check the status of the web container we can run the following command

    docker logs api-food-truck-php-1

The last log to confirm that the app is already up is:

**__INFO Server running on [http://0.0.0.0:1110].__**

# API Resquest

### Available users

#### Role : Email : Password

admin : "admin@test.com" : "123456"

user : "user@test.com" : "123456"

## Get Token

    method: POST

    endpoint: http://localhost:1110/v1/authentication/token

    headers: Accept / application/json

    body:

    {
        "email" : "admin@test.com",
        "password" : "123456"
    }

## Search Food Truck By Word In Body

### Allowed roles : [Admin]

    method: GET

    endpoint: http://localhost:1110/v1/foodtruck

    headers: Accept / application/json
    
    body:
    
    {
        "search" : "cochinita"
    }
    
    Authorization: Bearer Token

## Search Food Truck By ID

### Allowed roles : [Admin/User]

    method: GET
    
    endpoint: http://localhost:1110/v1/foodtruck/{objectid}  eg. http://localhost:1110/v1/foodtruck/1591828
    
    headers: Accept / application/json
    
    Authorization: Bearer Token


