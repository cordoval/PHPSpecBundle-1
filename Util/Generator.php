<?php

namespace PHPSpec\PHPSpecBundle\Util;

class Generator
{
    protected $promptToRunEnvironment = false;

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

    public function generateView($dirPath)
    {
        system('mkdir -p '.$dirPath);
        system('touch '.$dirPath.'/NewSpec.html.twig');
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