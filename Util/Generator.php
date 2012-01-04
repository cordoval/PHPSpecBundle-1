<?php

namespace PHPSpec\PHPSpecBundle\Util;

class Generator
{
    protected $promptToRunEnvironment = false;

    public function checkDirectoryExists($dirPath)
    {
        if (file_exists($dirPath)) {
            $exists = true;
        } else {
            $this->setPromptToRunEnvironment(true);
            $exists = false;
        }
        return $exists;
    }

    public function setPromptToRunEnvironment($value)
    {
        $this->promptToRunEnvironment = $value;
    }

    public function getPromptToRunEnvironment()
    {
        return $this->promptToRunEnvironment;
    }

    public function generateView($dirPath)
    {
        system('mkdir -p '.$dirPath);
        system('touch '.$dirPath.'/NewSpec.html.twig');
    }

    public function checkFileExists($filePath)
    {
        if (file_exists($filePath)) {
            $exists = true;
        } else {
            $exists = false;
        }
        return $exists;
    }

}