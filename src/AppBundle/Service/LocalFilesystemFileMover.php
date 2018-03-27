<?php

namespace AppBundle\Service;

use Symfony\Component\Filesystem\Filesystem;

class LocalFilesystemFileMover implements FileMover
{
    /**
     *
     * @var Filesystem 
     */
    private $filesystem;

    /**
     * 
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }
    
    /**
     * 
     * @param string $existingFilePath
     * @param string $newFilePath
     */
    public function move($existingFilePath, $newFilePath)
    {
        $this->filesystem->rename($existingFilePath, $newFilePath);
        
        return true;
    }
}
