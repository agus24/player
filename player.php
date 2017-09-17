<?php

use Symfony\Component\Finder\Finder;

class Player
{
    public static $file = [];
    public static function boot()
    {
        $finder = new Finder;
        $finder->files()
            ->in(__DIR__.'/music');
        foreach($finder as $file)
        {
            static::$file[] = "music/".$file->getRelativePathname();
        }
    }

    public static function getFile()
    {
        return static::$file;
    }
}
