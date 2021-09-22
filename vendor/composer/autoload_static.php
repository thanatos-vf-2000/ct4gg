<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit30c86bb7245e87878960f525be2a8e40
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CT4GG\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CT4GG\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit30c86bb7245e87878960f525be2a8e40::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit30c86bb7245e87878960f525be2a8e40::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
