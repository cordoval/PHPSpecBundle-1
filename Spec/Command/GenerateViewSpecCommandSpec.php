<?php

namespace PHPSpec\PHPSpecBundle\Spec\Command;

use PHPSpec\PHPSpecBundle\Util\Generator as Generator;
use Symfony\Bundle\FrameworkBundle\Spec\WebSpec;

class DescribeGenerateViewSpecCommand extends WebSpec
{
    public function before()
    {

    }

    public function itShouldGenerateViewInLineParameters()
    {
        $client = self::createClient();
        $output = $this->runCommand($client, "phpspec:generate:view-spec name-of-bundle:name-of-controller:name-of-view");

        $generator = $client->getKernel()->getContainer()->get('phpspec_generator');

        $generator->generateViewFor($bundleName, $controllerName, $viewName);

        $this->assertContains('view generated', $output);
    }

    /**
     * Runs a command and returns it output
     */
    public function runCommand(Client $client, $command)
    {
        $application = new Application($client->getKernel());
        $application->setAutoExit(false);

        $fp = tmpfile();
        $input = new StringInput($command);
        $output = new StreamOutput($fp);

        $application->run($input, $output);

        fseek($fp, 0);
        $output = '';
        while (!feof($fp)) {
            $output = fread($fp, 4096);
        }
        fclose($fp);

        return $output;
    }

}