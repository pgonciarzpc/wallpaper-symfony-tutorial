<?php

namespace AppBundle\Service;

/**
 * Description of WallpaperFilePathHelper
 *
 * @author kasia
 */
class WallpaperFilePathHelper
{
    /**
     *
     * @var string 
     */
    private $wallpaperFileDirectory;
    
    /**
     * 
     * @param string $wallpaperFileDirectory
     */
    public function __construct(string $wallpaperFileDirectory)
    {
        $this->wallpaperFileDirectory = $wallpaperFileDirectory;
    }

    /**
     * 
     * @param string $newFileName
     * @return string
     */
    public function getNewFilePath(string $newFileName)
    {
        return $this->wallpaperFileDirectory . $newFileName;
    }
}
