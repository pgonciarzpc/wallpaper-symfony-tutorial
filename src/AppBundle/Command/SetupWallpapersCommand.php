<?php

namespace AppBundle\Command;

use AppBundle\Entity\Wallpaper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;


class SetupWallpapersCommand extends Command
{
    /**
     *
     * @var string 
     */
    private $rootDir;

    /**
     *
     * @var EntityManagerInterface 
     */
    private $em;
    
    /**
     * 
     * @param string $rootDir
     */
    public function __construct(EntityManagerInterface $em, string $rootDir = './')
    {
        parent::__construct();
        
        $this->rootDir = $rootDir;
        $this->em = $em;
    }
    
    /**
     * 
     */
    protected function configure()
    {
        $this
            ->setName('app:setup-wallpapers')
            ->setDescription('Grabs all the local wallpapers and creates a Wallpaper entity for each one.')
//            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $argument = $input->getArgument('argument');
//
//        if ($input->getOption('option')) {
//            // ...
//        }

        $wallpapers = glob($this->rootDir . '/web/images/*.*');
        
        //exit(\Doctrine\Common\Util\Debug::dump($this->rootDir));
        
        foreach ($wallpapers as $wallpaper) {
            $wp = (new Wallpaper())
                    ->setFilename($wallpaper)
                    ->setSlug($wallpaper)
                    ->setHeight(1920)
                    ->setWidth(1080)
            ;
            
            $this->em->persist($wp);
        }
        
        $this->em->flush();
        
        //exit(\Doctrine\Common\Util\Debug::dump($wallpapers));
        
        $output->writeln('Command result.');
    }

}
