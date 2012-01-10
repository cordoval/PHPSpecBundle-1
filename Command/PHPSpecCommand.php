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
            ->setDescription('Execute PHPSpec examples(s) in specified bundle from Symfony2 console')
            ->addArgument('specFileOrDir', InputArgument::OPTIONAL, 'Usage: phpspec (FILE|DIRECTORY) + [options]', '.')
            ->addOption('backtrace', 'b', InputOption::VALUE_NONE, 'Enable full backtrace')
            ->addOption('colour', 'c', InputOption::VALUE_NONE, 'Enable color in the output')
            ->addOption('example', 'ex', InputOption::VALUE_REQUIRED, 'Run examples whose full nested names include STRING')
            ->addOption('formater', 'f', InputOption::VALUE_OPTIONAL, 'Choose a formatter')
            ->addOption('bootstrap', null, InputOption::VALUE_REQUIRED, 'Specify a bootstrap file to run before the tests')
            ->addOption('fail-fast', null, InputOption::VALUE_NONE, 'Abort the run on first failure')
        ;
    }

   protected function execute(InputInterface $input, OutputInterface $output)
   {
       $argv = array(
           0 => $input->getArgument('specFileOrDir'),
           1 => $input->getOption('backtrace')? '-b': null,
           2 => $input->getOption('colour')? '-c': null,
           3 => $input->getOption('example')? '-e '.$input->getOption('example') : null,
           4 => $input->getOption('formater')? '-f'.$input->getOption('formater') : null,
           5 => $input->getOption('bootstrap')? '--bootstrap '.$input->getOption('bootstrap') : null,
           6 => $input->getOption('fail-fast')? '--fail-fast' : null,
       );
       $phpspec = new PHPSpec($argv);
       $phpspec->execute();
   }
}
