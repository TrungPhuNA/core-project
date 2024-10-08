<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit13dffff9993de265bd37399869af5797
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\Project\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\Project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit13dffff9993de265bd37399869af5797::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit13dffff9993de265bd37399869af5797::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit13dffff9993de265bd37399869af5797::$classMap;

        }, null, ClassLoader::class);
    }
}
