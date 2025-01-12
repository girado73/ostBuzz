<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbcf42caac5601b1ac80a94f5f97f3b22
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

        spl_autoload_register(array('ComposerAutoloaderInitbcf42caac5601b1ac80a94f5f97f3b22', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbcf42caac5601b1ac80a94f5f97f3b22', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbcf42caac5601b1ac80a94f5f97f3b22::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
