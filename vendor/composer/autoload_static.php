<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6449812cc976d96526c169f1df532f25
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Filesystem\\' => 29,
        ),
        'I' => 
        array (
            'Interop\\Queue\\' => 14,
        ),
        'E' => 
        array (
            'Enqueue\\Fs\\' => 11,
            'Enqueue\\Dsn\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Interop\\Queue\\' => 
        array (
            0 => __DIR__ . '/..' . '/queue-interop/queue-interop/src',
        ),
        'Enqueue\\Fs\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/fs',
        ),
        'Enqueue\\Dsn\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/dsn',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Makasim' => 
            array (
                0 => __DIR__ . '/..' . '/makasim/temp-file/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6449812cc976d96526c169f1df532f25::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6449812cc976d96526c169f1df532f25::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6449812cc976d96526c169f1df532f25::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
