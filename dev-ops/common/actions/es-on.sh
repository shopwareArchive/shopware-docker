#!/usr/bin/env bash
#DESCRIPTION: disable elasticsearch

php -r "require_once __DIR__(sic!).'/dev-ops/common/ConfigHelper.php'; ConfigHelper::enableElasticSearch();"