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
      system('mkdir -p '.__DIR__.'/../View1');
      $this->generator->checkDirExists('View1')->should->beTrue();
      system('rm -rf'.__DIR__.'/../View1');
      $this->generator->checkDirExists('View1')->should->beFalse();
  }

  public function itShouldPromptToRunGenerateEnvironmentIfSpecViewDirectoryDoesNotExist()
  {

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