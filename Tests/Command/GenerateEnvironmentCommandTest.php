<?php
use PHPSpec\PHPSpecBundle\Tests\CommandTestCase;

 class GenerateViewSpecCommandTest extends CommandTestCase
 {
     public function testDefaultDoesNotInstall()
     {
         $client = self::createClient();
         $output = $this->runCommand($client, "phpspec:generate:view-spec name-of-bundle:name-of-controller:name-of-view");

         $generator = $client->getKernel()->getContainer()->get('phpspec_generator');

         $generator->generateViewFor($bundleName, $controllerName, $viewName);

         $this->assertContains('view generated', $output);
     }
 }