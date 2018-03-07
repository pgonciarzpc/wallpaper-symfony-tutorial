<?php

namespace AppBundle\Command;

use AppBundle\Entity\Wallpaper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


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

        $io = new SymfonyStyle($input, $output);
        
        $wallpapers = glob($this->rootDir . '/web/images/*.*');
        
        $walpaperCount = count($wallpapers);
        
        $io->title('Importing wallpapers');
        
        $io->progressStart($walpaperCount);
        
        $fileNames = [];
        
        //exit(\Doctrine\Common\Util\Debug::dump($this->rootDir));
        
        foreach ($wallpapers as $wallpaper) {
            
            $pi = pathinfo($wallpaper);
            $gis = getimagesize($wallpaper);
            
            $filename = $pi['basename'];
            $slug = $pi['filename'];
            
            $width = $gis[0];
            $height = $gis[1];
            
            $wp = (new Wallpaper())
                    ->setFilename($filename)
                    ->setSlug($slug)
                    ->setHeight($height)
                    ->setWidth($width)
            ;
            
            $this->em->persist($wp);
            
            $io->progressAdvance();
            
            $fileNames[] = [$filename];
        }
        
        $this->em->flush();
        
        $io->progressFinish();
        
        $table = new Table($output);
        $table
            ->setHeaders(['Filename'])
            ->setRows($fileNames)
        ;
        $table->render();
        
        $io->success(sprintf('Cool, we added %d wallpapers. ', $walpaperCount));
        //exit(\Doctrine\Common\Util\Debug::dump($wallpapers));
        
//        $output->writeln('Command result.');
    }

}
