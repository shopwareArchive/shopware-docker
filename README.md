Docker Shopware Box
====================

## Installation

Docker (min. Version 1.12) have to be installed on your local machine:

 - [Docker](https://docs.docker.com/engine/installation/linux/)

## Usage

Clone the repository to your local machine.

    $ git clone https://github.com/shopwareLabs/shopware-docker
    $ cd shopware-docker

Boot up your docker containers with psh.phar:

    $ ./psh.phar docker:start

The first boot may take a while, so feel free to get a cup of coffee.

Your machine will be available at [http://10.100.111.46/](http://10.100.111.46/)
All required tools like the LAMP stack are already installed.

- MySQL user: `app`, password: `app`

To SSH into the created Container:

    $ ./psh.phar docker:ssh

## Installing Shopware

SSH first into your VM:

    $ ./psh.phar docker:ssh
    
Call the init script:

    $ ./psh.phar init
    
This will download the latest release version of shopware and install it into /var/www/shopware/shopware

Configure your online store in a web browser with the credentials demo/demo:

- Backend: [http://10.100.111.46/backend/](http://10.100.111.46/backend/)

You can then access your storefront at:

- Front-end: [http://10.100.111.46/](http://10.100.111.46/)

## Troubleshooting 

If the docker or redis container didn't start make sure that the directory dev-ops/docker/_volumes/app-esdata|app-redisdata has chmod 777. 