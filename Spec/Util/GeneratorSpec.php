<?php

namespace PHPSpec\PHPSpecBundle\Spec\Util;

use PHPSpec\PHPSpecBundle\Util\Generator as Generator;

class DescribeGenerator extends \PHPSpec\Context
{
    protected $generator;

    public function before()
    {
        $this->generator = $this->spec(new Generator);
    }

    public function itShouldCheckIfSpecViewDirectoryExists()
    {
        $dirPath = __DIR__.'/../View1';
        system('mkdir -p '.$dirPath);
        $this->generator->checkDirectoryExists($dirPath)->should->beTrue();
        system('rm -rf '.$dirPath);
        $this->generator->checkDirectoryExists($dirPath)->should->beFalse();
    }

    public function itShouldPromptToRunGenerateEnvironmentIfSpecViewDirectoryDoesNotExist()
    {
        $dirPath = __DIR__.'/../View1';
        system('rm -rf '.$dirPath);
        $this->generator->checkDirectoryExists($dirPath)->should->beFalse();
        $this->generator->getPromptToRunEnvironment()->should->beTrue();
    }

    public function itShouldGenerateViewUnderResourcesControllerDirectory()
    {
        $dirPath = __DIR__.'/../../Resources1/views/Default/';
        $filePath = __DIR__.'/../../Resources1/views/Default/NewSpec.html.twig';
        system('rm -rf '.$dirPath);
        $this->generator->checkDirectoryExists($dirPath)->should->beFalse();
        $this->generator->generateView($dirPath);
        $this->generator->checkFileExists($filePath)->should->beTrue();
        system('rm -rf '.$dirPath);
    }

    public function itShouldGenerateViewSpecInTheSpecFolderUnderAFolderWithTheNameOfTheController()
    {
        $filePath = __DIR__.'/../View1/Default/NewViewSpec.html.twig.php';
        $dirPath = __DIR__.'/../View1/Default';
        //system('rm '.$filePath);
        $this->generator->generateViewSpec($filePath, $dirPath);
        $this->generator->checkFileExists($filePath)->should->beTrue();
        system('rm '.$filePath);
    }

    public function itShouldAddAnExampleThatSpecifiesThatTheViewHasTheSymfonyDefaultContentForAView()
    {
        // examples are harder not sure how to read and make sure the public function is there
    }
}