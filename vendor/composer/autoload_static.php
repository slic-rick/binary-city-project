<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b::$classMap;

        }, null, ClassLoader::class);
    }
}