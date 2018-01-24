#!/usr/bin/env bash
#DESCRIPTION: enable csrf protection

php -r "require_once __DIR__(sic!).'/dev-ops/common/ConfigHelper.php'; ConfigHelper::enableCsrfProtection();"