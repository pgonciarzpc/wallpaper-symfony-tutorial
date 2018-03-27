<?php

namespace AppBundle\Service;

/**
 *
 * @author kasia
 */
interface FileMover
{
    /**
     * 
     * @param string $existingFilePath
     * @param string $newFilePath
     */
    public function move($existingFilePath, $newFilePath);
    
}
