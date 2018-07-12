# Cash-Machine

## Installation
on the commandline run:
```sh
docker-compose up -d \
docker exec -it app composer install
```
this will setup the correct envoirnment for you. so you can just open ```localhost``` in the browser.
if you don't want to use docker - just install php 7.0+ and nginx, do make sure nginx points to ```application/public``` folder.

## Endpoints

view for interacting with the cash machine: 
	```GET /```

withdrawing the cash notes using the api:
	```GET api/v1/withdraw```

## Chosen Framework
lumen as a microframework.



