<?php

namespace App\Command;

use App\Entity\Wallpaper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupWallpapersCommand extends Command
{
    private $em;

    protected static $defaultName = 'app:setup-wallpapers';


    public function __construct(?string $name = null, EntityManagerInterface $em)
    {
        parent::__construct($name);

        $this->em = $em;
    }

    private function gimmePath(){
        return realpath(__DIR__ . '/../../public');
    }

//    private function kviri(){
//        $query = "SELECT * from wallpapers";
//        $rs = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($query);
//
//        return $rs;
//    }
    protected function configure()
    {
        $this
            ->setName('app:setup-wallpapers')
            ->setDescription('Grabs all the local wallpapers and creates a Wallpaper entity for each one')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $wallpapers = glob($this->gimmePath() . '/img/*.*');
        $wallpaperCount = count($wallpapers);

        $io->title('Importing Wallpapers');
        $io->progressStart($wallpaperCount);

        $fileNames = [];

        foreach ($wallpapers as $wallpaper){

            [
                'basename' => $filename,
                'filename' => $slug
            ] = pathinfo($wallpaper);
            [
                0 => $width,
                1 => $height

            ] = getimagesize($wallpaper);


            $wp = (new Wallpaper())
                ->setFilename($wallpaper)
                ->setSlug($wallpaper)
                ->setWidth(1920)
                ->setHeight(1080)
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

        $io->success(sprintf('Cool we added %d wallpapers', $wallpaperCount));
    }
}
