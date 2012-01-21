<?php

namespace PHPSpec\PHPSpecBundle\Spec\Command;

use PHPSpec\PHPSpecBundle\Util\Generator as Generator;
use PHPSpec\PHPSpecBundle\Support\WebSpec;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Bundle\FrameworkBundle\Client;
use PHPSpec\PHPSpecBundle\Util\CommandOutput;

class DescribeGenerateViewSpecCommand extends WebSpec
{
    protected $commandOutput;

    public function before()
    {
        $this->commandOutput = $this->spec(new CommandOutput());
    }

    public function xitShouldGenerateViewInLineParameters()
    {
        $client = self::createClient();
        $output = $this->runCommand($client, "phpspec:generate:view-spec name-of-bundle:name-of-controller:name-of-view");
        $this->commandOutput->passOutput($output)->should->be('view2 generated');
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