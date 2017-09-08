<?php

class ConfigHelper
{
    const CONFIG_PATH = __DIR__ . '/../../shopware/config.php';

    public static function enableElasticSearch()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        $config['es'] = [
            'enabled' => true,
            'number_of_replicas' => 0,
            'number_of_shards' => null,
            'client' => [
                'hosts' => [
                    '172.17.0.2:9200',
                ],
            ],
        ];

        self::saveConfig($config);
    }

    public static function enableDebug()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        $config['errorHandler'] = [
            'throwOnRecoverableError' => true,
        ];

        $config['front'] = [
            'noErrorHandler' => true,
            'throwExceptions' => true,
            'disableOutputBuffering' => true,
            'showException' => true,
        ];

        $config['model'] = [
            'cacheProvider' => 'array',
        ];

        $config['phpsettings'] = [
            'error_reporting' => E_ALL,
            'display_errors' => 1,
        ];

        self::saveConfig($config);
    }

    public static function enableCsrfProtection()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        if (isset($config['csrfprotection'])) {
            unset($config['csrfprotection']);
        }

        self::saveConfig($config);
    }

    public static function disableElasticSearch()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        if (isset($config['es'])) {
            unset($config['es']);
        }

        self::saveConfig($config);
    }

    public static function disableDebug()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        if (isset($config['errorHandler'])) {
            unset($config['errorHandler']);
        }

        if (isset($config['front'])) {
            unset($config['front']);
        }

        if (isset($config['model'])) {
            unset($config['model']);
        }

        if (isset($config['phpsettings'])) {
            unset($config['phpsettings']);
        }

        self::saveConfig($config);
    }

    public static function disableCsrfProtection()
    {
        $config = self::getConfig(self::CONFIG_PATH);

        $config['csrfprotection'] = [
            'frontend' => false,
            'backend' => false,
        ];

        self::saveConfig($config);
    }

    private static function getConfig($configPath)
    {
        if (!file_exists($configPath)) {
            throw new RuntimeException('please install shopware first!');
        }

        return include $configPath;
    }

    private static function saveConfig($config)
    {
        $configFile = '<?php return ' . var_export($config, true) . ';';
        file_put_contents(self::CONFIG_PATH, $configFile);
    }
}