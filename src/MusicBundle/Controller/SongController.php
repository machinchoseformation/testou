<?php

namespace MusicBundle\Controller;


use MusicBundle\Form\SongType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SongController extends Controller
{
    /**
     * Liste des albums
     */
    public function listSongsAction($artistSlug, $albumId)
    {
        $albumsRepo = $this->getDoctrine()->getRepository("MusicBundle:Album");
        $album = $albumsRepo->find($albumId);

        $songsRepo = $this->getDoctrine()->getRepository("MusicBundle:Song");
        $songs = $songsRepo->findBy(["album" => $album], ["number" => "ASC"]);

        return $this->render('MusicBundle:Song:list_songs.html.twig', [
            "album" => $album,
            "artist" => $album->getArtist(),
            "songs" => $songs
        ]);
    }

    public function addSongAction($artistSlug, $albumId)
    {
        return new Response("todo");
    }

    public function editSongAction($artistSlug, $albumId, $songId, Request $request)
    {
        $albumsRepo = $this->getDoctrine()->getRepository("MusicBundle:Album");
        $album = $albumsRepo->find($albumId);

        $songsRepo = $this->getDoctrine()->getRepository("MusicBundle:Song");
        $song = $songsRepo->find($songId);

        $songForm = $this->createForm(SongType::class, $song);

        $songForm->handleRequest($request);
        if ($songForm->isSubmitted() && $songForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);
            $em->flush();

            $this->addFlash("success", "La chanson a bien été sauvegardée !");
            return $this->redirectToRoute("list_songs", ["albumId" => $albumId, "artistSlug" => $artistSlug]);
        }

        return $this->render("MusicBundle:Song:edit_song.html.twig", [
            "album" => $album,
            "artist" => $album->getArtist(),
            "song" => $song,
            "form" => $songForm->createView()
        ]);
    }
}
