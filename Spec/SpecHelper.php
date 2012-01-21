<?php

require_once 'PHPSpec/Loader/UniversalClassLoader.php';
#require_once __DIR__.'/../../../../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use PHPSpec\Loader\UniversalClassLoader;
#use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PHPSpec'          => __DIR__.'/../../../',
    'Symfony'          => array(__DIR__.'/../../../../../vendor/symfony/src', __DIR__.'/../../../../../vendor/bundles'),
    'Assetic'          => __DIR__.'/../../../../../vendor/assetic/src',
    'Sensio'           => __DIR__.'/../../../../../vendor/bundles',
    'JMS'              => __DIR__.'/../../../../../vendor/bundles',
    'Doctrine\\Bundle' => __DIR__.'/../../../../../vendor/bundles',
    'Doctrine\\Common' => __DIR__.'/../../../../../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../../../../../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../../../../../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../../../../../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../../../../../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../../../../../vendor/metadata/src',
    'Acme'             => __DIR__.'/../../../../../src',
    'PSS'              => __DIR__.'/../../../../../vendor/bundles',
));

$loader->register();