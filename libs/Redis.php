<?php

namespace Services;

use Predis\Client;

class Redis
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            $redis_env    = config('redis_env');
            $redis_config = config($redis_env);
            $parameters   = [
                'scheme' => 'tcp',
                'host'   => $redis_config['host'],
                'port'   => $redis_config['port'],
            ];
            if (isset($redis_config['password'])) {
                $parameters['password'] = $redis_config['password'];
            }
            self::$instance = new Client($parameters);
        }
        return self::$instance;
    }
}