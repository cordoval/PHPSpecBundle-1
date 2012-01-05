<?php

require_once 'PHPSpec/Loader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PHPSpec'          => __DIR__.'/../../../',
));

$loader->register();