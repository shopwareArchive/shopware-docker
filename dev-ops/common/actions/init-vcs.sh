#!/usr/bin/env bash
#DESCRIPTION: executes on app_webserver to provision a vcs environment

rm -rf ./shopware
git clone --depth 1 -b __SW-BRANCH__ https://github.com/shopware/shopware.git

cd shopware/ && composer install && composer dump-autoload --optimize

ant -f shopware/build/build.xml -Ddb.user=__DB_USER__ -Ddb.password=__DB_PASSWORD__ -Ddb.host=__DB_HOST__ -Ddb.name=__DB_NAME__ -Dapp.host=__SW_HOST__ build-cache-dir build-config build-database build-generate-attributes build-snippets-deploy build-theme-initialize build-create-admin-account build-install-lock-file build-disable-firstrunwizard install-git-hooks

shopware/bin/console sw:firstrunwizard:disable