#!/usr/bin/env bash
#DESCRIPTION: executes on app_webserver to link local frontend themes

I: find shopware/themes/Frontend/ -type l | xargs -r rm
ls themes/ | while read file; do ln -s ../../../themes/$file shopware/themes/Frontend/$file; done