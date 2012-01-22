<?php

namespace PHPSpec\PHPSpecBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
//use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator;
use PHPSpec\PHPSpecBundle\Util\Generator;
use Sensio\Bundle\GeneratorBundle\Manipulator\KernelManipulator;
use Sensio\Bundle\GeneratorBundle\Manipulator\RoutingManipulator;
use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;

/**
 * Generates view and its spec template.
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class GenerateViewSpecCommand extends ContainerAwareCommand
{
    private $generator;

    /*
     * $generator = $client->getKernel()->getContainer()->get('php_spec.generator');
     * $generator->generateViewFor($bundleName, $controllerName, $viewName);
     */

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setDefinition(array(
                new InputOption('namespace', '', InputOption::VALUE_REQUIRED, 'The namespace of the working bundle'),
                new InputOption('dir', '', InputOption::VALUE_REQUIRED, 'The base directory the bundle is located'),
                new InputOption('bundle-name', '', InputOption::VALUE_REQUIRED, 'The optional bundle name'),
            ))
            ->setDescription('Generates a view and its spec for a specified bundle')
            ->setHelp(<<<EOT
<info>php app/console phpspec:generate:view-spec --namespace=Acme/BlogBundle</info>

Note that you can use <comment>/</comment> instead of <comment>\\</comment> for the namespace delimiter to avoid any
problem.

If you want to disable any user interaction, use <comment>--no-interaction</comment> but don't forget to pass all needed options:

<info>php app/console phpspec:generate:view-spec --namespace=Acme/BlogBundle --dir=src [--bundle-name=...] --no-interaction</info>

Note that the bundle namespace must end with "Bundle".
EOT
            )
            ->setName('phpspec:generate:view-spec')
        ;
    }


    /**
     * @see Command
     *
     * @throws \InvalidArgumentException When namespace doesn't end with Bundle
     * @throws \RuntimeException         When bundle can't be executed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();

        if ($input->isInteractive()) {
            if (!$dialog->askConfirmation($output, $dialog->getQuestion('Do you confirm generation', 'yes', '?'), true)) {
                $output->writeln('<error>Command aborted</error>');

                return 1;
            }
        }

        foreach (array('namespace', 'dir') as $option) {
            if (null === $input->getOption($option)) {
                throw new \RuntimeException(sprintf('The "%s" option must be provided.', $option));
            }
        }

        //$namespace = Validators::validateBundleNamespace($input->getOption('namespace'));
        $namespace = $input->getOption('namespace');
        if (!$bundle = $input->getOption('bundle-name')) {
            $bundle = strtr($namespace, array('\\' => ''));
        }
        //$bundle = Validators::validateBundleName($bundle);
        //$dir = Validators::validateTargetDir($input->getOption('dir'), $bundle, $namespace);
        $dir = $input->getOption('dir');

        $dialog->writeSection($output, 'View Spec generation');

        if (!$this->getContainer()->get('filesystem')->isAbsolutePath($dir)) {
            $dir = getcwd().'/'.$dir;
        }

        $generator = $this->getGenerator();
        $generator->generate($namespace, $bundle, $dir);

        $output->writeln('Generating the view spec code: <info>OK</info>');

        $errors = array();
        $runner = $dialog->getRunner($output, $errors);

        $dialog->writeGeneratorSummary($output, $errors);
    }

    protected function getGenerator()
    {
        if (null === $this->generator) {
            $this->generator = new Generator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/bundle');
        }

        return $this->generator;
    }

    protected function getDialogHelper()
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (!$dialog || get_class($dialog) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper') {
            $this->getHelperSet()->set($dialog = new DialogHelper());
        }

        return $dialog;
    }
}