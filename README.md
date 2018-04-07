# ctfrepo
A repository of CTF challenges

## Setup

The only setup required is to run [Composer](https://getcomposer.org) and install the required packages:

```
composer install
```

## Running

You can either run the application through the PHP command line web server:

```
cd public
php -S localhost:8080
```

or you can set up your favorite web server and use the `public/` directory as the document root.

## Setting up services

1. Create a `.env` file in the base directory that looks like this:

```
DO_TOKEN=[your Digital Ocean token]

```

## Deploying to Digital Ocean

To name the droplet "blog" with the current Dockerfile and docker-compose.yml

1. to set the Digital Ocean token: `export DO_TOKEN="...."`
2. To create the droplet: `docker-machine create --driver=digitalocean --digitalocean-access-token=$DO_TOKEN --digitalocean-size=1gb [name]`
3. to get the command to switch to the machine: `docker-machine env [name]`
4. to switch to the machine: `eval $(docker-machine env [name])`
5. To build the remote machine according to the configs: `docker-compose up -d --build`

## To "ssh" into a container

1. Connect to the machine: `docker-machine ssh blog`
2. Get the current containers: `docker ps`
3. Use this command to "ssh" into the container: `docker exec -it <mycontainer> bash`

For example, if the container name is `ctfrepodocker_web_1` you would use: `docker exec -it ctfrepodocker_web_1 bash`
