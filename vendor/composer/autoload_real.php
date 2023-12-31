<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit28ae56f3f44230acd2ded0312e4f802e
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit28ae56f3f44230acd2ded0312e4f802e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit28ae56f3f44230acd2ded0312e4f802e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit28ae56f3f44230acd2ded0312e4f802e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
