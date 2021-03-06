<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit403f657ff754de0d20fecc42b56ff0fe
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Contracts\\' => 18,
            'Symfony\\Component\\Console\\' => 26,
        ),
        'M' => 
        array (
            'Mycmd\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/contracts',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Mycmd\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Mycmd',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit403f657ff754de0d20fecc42b56ff0fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit403f657ff754de0d20fecc42b56ff0fe::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
