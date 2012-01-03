<?php

namespace PHPSpec\PHPSpecBundle\Spec\Command;

class ViewSpecCommandSpec extends \PHPSpec\Context;
{

  public function before()
  {
      $this->generator = $this->spec(new Generator);
  }
  public function itShouldCheckIfSpecViewDirectoryExists()
  {
      system('mkdir -p View');
      $this->generator->checkDirExists('View');
      $this->generator->viewDirExists->should->equal(true);
      system('rm -rf View');
      $this->generator->checkDirExists('View');
      $this->generator->viewDirExists->should->equal(false);
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