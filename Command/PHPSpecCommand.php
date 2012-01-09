<?php

namespace PHPSpec\PHPSpecBundle\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use PHPSpec\Runner\Cli\Runner as CliRunner,
    PHPSpec\PHPSpec;

class PHPSpecCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('phpspec')
            ->setDescription('Execute PHPSpec examples(s) in specified bundle')
            ->addArgument('specFile', InputArgument::OPTIONAL, CliRunner::USAGE
            )
        ;
    }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
       $specFile = $input->getArgument('specFile');
       $argv = array(0 => $specFile);
       $phpspec = new PHPSpec($argv);
       $phpspec->execute();
   }
}
