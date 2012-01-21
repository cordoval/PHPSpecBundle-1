<?php
class {{ bundle }} extends Bundle

namespace {{ namespace }}\Spec\View;

use PHPSpec\PHPSpecBundle\Context\ViewContext;

class DescribeIndex extends ViewContext
{
    public function itShouldRenderSomeHelloWorld()
    {
        $template = 'index.html.twig';
        $var1 = 'hello world!';
        $parameters = array('var1' => $var1);
        $this->view->render($template, $parameters)->should->be('hello world!');
    }
}