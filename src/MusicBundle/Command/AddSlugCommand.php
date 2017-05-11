<?php

namespace MusicBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddSlugCommand extends ContainerAwareCommand
{
    private $io;
    private $doctrine;

    public function configure()
    {
        $this
            ->setName('app:slugify')
            ->setDescription('Ajoute en bdd des slugs pour les artistes et les albums');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->io->text("C'est parti !");

        $this->doctrine = $this->getContainer()->get('doctrine');

        $this->addSlugToArtists();
    }

    private function addSlugToArtists()
    {
        $artistRepo = $this->doctrine->getRepository("MusicBundle:Artist");
        $artists = $artistRepo->findAll();

        $em = $this->doctrine->getManager();
        $slugify = new \Cocur\Slugify\Slugify();

        $this->io->section("Artistes");

        foreach($artists as $artist)
        {
            $slug = $slugify->slugify($artist->getName());
            $artist->setSlug($slug);

            $this->io->text($artist->getName() . " > " . $artist->getSlug());

            $em->persist($artist);
        }
        $em->flush();
    }
}