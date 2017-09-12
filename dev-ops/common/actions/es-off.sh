#!/usr/bin/env bash
#DESCRIPTION: enable elasticsearch

php -r "require_once __DIR__(sic!).'/dev-ops/common/ConfigHelper.php'; ConfigHelper::disableElasticSearch();"