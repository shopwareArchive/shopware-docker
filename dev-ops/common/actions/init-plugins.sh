#!/usr/bin/env bash
#DESCRIPTION: executes on app_webserver to install the local plugins

I: find shopware/custom/plugins/ -type l | xargs rm
ls plugins/ | while read file; do ln -s ../../../plugins/$file shopware/custom/plugins/$file; done
shopware/bin/console sw:plugin:refresh
shopware/bin/console sw:plugin:list
I: ls plugins/ | while read file; do shopware/bin/console sw:plugin:uninstall $file; done;
ls plugins/ | while read file; do shopware/bin/console sw:plugin:install --activate $file; done;