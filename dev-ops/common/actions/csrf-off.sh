#!/usr/bin/env bash
#DESCRIPTION: disable csrf protection

php -r "require_once __DIR__(sic!).'/dev-ops/common/ConfigHelper.php'; ConfigHelper::disableCsrfProtection();"