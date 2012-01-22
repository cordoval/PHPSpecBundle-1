<?php

namespace PHPSpec\PHPSpecBundle\Util;

use Sensio\Bundle\GeneratorBundle\Generator\Generator as BaseGenerator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\Container;

class Generator extends BaseGenerator
{
    private $promptToRunEnvironment = false;
    private $filesystem;
    private $skeletonDir;

    public function __construct(Filesystem $filesystem, $skeletonDir)
    {
        $this->filesystem = $filesystem;
        $this->skeletonDir = $skeletonDir;
    }

    public function generate($namespace, $bundle, $dir)
    {
        $dir .= '/'.strtr($namespace, '\\', '/');
        $basename = substr($bundle, 0, -6);
        $parameters = array(
           'namespace' => $namespace,
           'bundle'    => $bundle,
           'bundle_basename' => $basename,
           'extension_alias' => Container::underscore($basename),
        );

        // generates view
        $this->renderFile($this->skeletonDir, 'NewSpec.html.twig', $dir.'/Resources/views/'.$controllerName.'/NewSpec.html.twig', $parameters);

        // generates the spec for view
        $this->renderFile($this->skeletonDir, 'NewSpec.html.twig', $dir.'/Resources/views/'.$controllerName.'/NewSpec.html.twig', $parameters);
    }

    public function checkDirectoryExists($dirPath)
    {
        if (!$directoryExists = file_exists($dirPath)) {
            $this->setPromptToRunEnvironment(true);
        }
        return $directoryExists;
    }

    public function setPromptToRunEnvironment($value)
    {
        $this->promptToRunEnvironment = $value;
    }

    public function getPromptToRunEnvironment()
    {
        return $this->promptToRunEnvironment;
    }

    public function generateView($dir)
    {
        $this->renderFile($this->skeletonDir, 'NewSpec.html.twig', $dir.'/Resources/views/'.$controllerName.'/NewSpec.html.twig', $parameters);
    }

    public function checkFileExists($filePath)
    {
        return file_exists($filePath);
    }

    public function generateViewSpec($filePath, $dirPath)
    {
        system('mkdir -p '.$dirPath);
        system('touch '.$filePath);
    }
}