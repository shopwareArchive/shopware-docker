FROM php:7.1-apache

RUN apt-get update -qq && apt-get install -y -qq \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        software-properties-common  \
        libcurl3 curl \
        git \
        zip \
        unzip \
        inotify-tools

RUN apt-get update -qq && apt-get install -y -qq \
        build-essential \
        libxml2-dev libxslt1-dev zlib1g-dev \
        git \
        mysql-client \
        sshpass \
        nano \
        sudo \
        vim \
        graphviz \
        netcat-openbsd

RUN docker-php-ext-install iconv mcrypt mbstring \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install curl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN pecl install redis \
    && docker-php-ext-enable redis

ADD server-apache2-vhosts.conf /etc/apache2/sites-enabled/000-default.conf
ADD server-apache2-run-as.conf /etc/apache2/conf-available
RUN ln -s /etc/apache2/conf-available/server-apache2-run-as.conf /etc/apache2/conf-enabled

ADD php-config.ini /usr/local/etc/php/conf.d/php-config.ini
ADD timezone-berlin.ini /usr/local/etc/php/conf.d/timezone.ini
ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN a2enmod rewrite

COPY createuser.sh /tmp/createuser.sh
RUN chmod +rwx /tmp/createuser.sh
RUN /tmp/createuser.sh

RUN echo "alias ll='ls -ahl'" >> /etc/bash.bashrc

WORKDIR /var/www/shopware

COPY wait.sh /tmp/wait.sh
RUN chmod +x /tmp/wait.sh

COPY id_rsa /home/app-shell/.ssh
COPY id_rsa.pub /home/app-shell/.ssh

COPY run-container.sh /run-container.sh
RUN chmod +x /run-container.sh

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer
RUN php -r "unlink('composer-setup.php');"

CMD /run-container.sh
