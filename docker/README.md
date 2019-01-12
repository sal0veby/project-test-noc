# Read me
Just a read me.

## Usage

Collection of docker commands for using in this project.

### Create .env file

`cp env-example .env`

### Create server

`docker-compose build`

### Start server

`docker-compose up -d`

### Rebuild server

`docker-compose down && docker-compose build`

### Remove server and data

Use this for clean up server and remove persistent data from docker host.

`docker-compose down -v`

#### Note

- `-v` mean remove volumes that created from this docker-compose.


### Clean up image
Use this for clean up space by remove old images and unused images.

`docker image prune -a`

#### Note

- `-a` mean remove unused images.