<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbdf51b8ba3e0f3f1ce3d71c800f6ad4b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
