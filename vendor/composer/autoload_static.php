<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53b11507b48e42948b50999b323f8e94
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PagSeguro\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PagSeguro\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagseguro/pagseguro-php-sdk/source',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit53b11507b48e42948b50999b323f8e94::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit53b11507b48e42948b50999b323f8e94::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit53b11507b48e42948b50999b323f8e94::$classMap;

        }, null, ClassLoader::class);
    }
}
