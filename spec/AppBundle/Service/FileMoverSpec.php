<?php

namespace spec\AppBundle\Service;

use AppBundle\Service\FileMover;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Filesystem\Filesystem;

class FileMoverSpec extends ObjectBehavior
{
    /**
     *
     * @var Filesystem 
     */
    private $filesystem;
    
    /**
     * 
     * @param Filesystem $fs
     */
    public function let(Filesystem $fs)
    {
        //exit(\Doctrine\Common\Util\Debug::dump($fs));
        
        $this->filesystem = $fs;
        
        $this->beConstructedWith($fs);
    }
    
    /**
     * 
     */
    function it_is_initializable()
    {
        $this->shouldHaveType(FileMover::class);
    }
    
    public function it_can_move_a_file_from_temporary_to_controlled_storage()
    {
        $currentLocation = '/temp/path';
        $newLocation = '/web/images/ ';
        
        $this->move($currentLocation, $newLocation)->shouldReturn(true);
        
        $this->filesystem->rename($newLocation, $currentLocation)->shouldHaveBeenCalled();
    }
}
