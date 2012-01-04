<?php

namespace PHPSpec\PHPSpecBundle\Spec\Command;

use PHPSpec\PHPSpecBundle\Util\Generator as Generator;

class DescribeGenerateViewSpecCommand extends \PHPSpec\Context
{

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

  }

  public function itShouldGenerateViewSpecInTheSpecFolderUnderAFolderWithTheNameOfTheController()
  {

  }

  public function itShouldAddAnExampleThatSpecifiesThatTheViewHasTheSymfonyDefaultContentForAView()
  {

  }
}