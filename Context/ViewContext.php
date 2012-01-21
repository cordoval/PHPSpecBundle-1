<?php

namespace PHPSpec\PHPSpecBundle\Context;

use Twig_Loader_Filesystem;
use Twig_Environment;

class ViewContext extends \PHPSpec\Context
{
    protected $twig;
    protected $view;

    public function before()
    {
        $dir = __DIR__.'/../Resources/skeleton/view-spec';
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem($dir), array(
            'debug'            => true,
            'cache'            => false,
            'strict_variables' => true,
            'autoescape'       => false,
        ));

        $this->view = $this->spec($this->twig);
    }
}
