<?php

require_once 'PHPSpec/Loader/UniversalClassLoader.php';

use PHPSpec\Loader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PHPSpec'          => __DIR__.'/../../../',
));

$loader->register();