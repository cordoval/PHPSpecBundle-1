<?php

require_once __DIR__.'/../../../../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PHPSpec'          => __DIR__.'/../../../',
));

$loader->register();