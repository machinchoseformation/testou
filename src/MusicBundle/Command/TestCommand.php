<?php

namespace MusicBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class TestCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('app:go')
            ->setDescription('commande perso de test');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->text('coucou !');

        $doctrine = $this->getContainer()->get('doctrine');
        $repo = $doctrine->getRepository("MusicBundle:Song");

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://ikonal.com/100-chats');

        $html = (string) $res->getBody();
        file_put_contents("test.html", $html);

        //DomCrawler
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('#gallery-2 img');

        $crawler->each(function($node, $i) use ($io){
            $io->text($node->attr('src'));

            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', $node->attr('src'));
            file_put_contents("$i.jpg", (string) $res->getBody());
        });
    }
}