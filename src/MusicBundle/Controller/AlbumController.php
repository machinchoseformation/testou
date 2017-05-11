<?php

namespace MusicBundle\Controller;

use MusicBundle\Entity\Album;
use MusicBundle\Form\AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AlbumController extends Controller
{
    /**
     * Liste des albums
     */
    public function listAlbumsAction($artistSlug)
    {
        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artist = $artistsRepo->findOneBySlug($artistSlug);

        return $this->render('MusicBundle:Album:list_albums.html.twig', [
            "albums" => $artist->getAlbums(),
            "artist" => $artist
        ]);
    }

    /**
     * Ajout d'album
     */
    public function addAlbumAction(Request $request, $artistSlug)
    {
        $em = $this->getDoctrine()->getManager();

        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);

        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artist = $artistsRepo->findOneBySlug($artistSlug);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($album);
            $em->flush();

            $this->addFlash('success', "L'album a bien été créé !");
            return $this->redirectToRoute('list_albums', ["artistSlug" => $artistSlug]);
        }

        return $this->render('MusicBundle:Album:add_album.html.twig', [
            "artist" => $artist,
            "form" => $form->createView()
        ]);
    }

    /**
     * Modification d'album
     */
    public function editAlbumAction(Request $request, $albumId, $artistSlug)
    {
        $em = $this->getDoctrine()->getManager();

        $albumsRepo = $this->getDoctrine()->getRepository("MusicBundle:Album");
        $album = $albumsRepo->find($albumId);

        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artist = $artistsRepo->findOneBySlug($artistSlug);

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($album);
            $em->flush();

            $this->addFlash('success', "L'album a bien été modifié !");
            return $this->redirectToRoute('list_albums', ["artistSlug" => $artistSlug]);
        }

        return $this->render('MusicBundle:Album:edit_album.html.twig', [
            "artist" => $artist,
            "album" => $album,
            "form" => $form->createView()
        ]);
    }

    /**
     * Suppression d'album
     */
    public function deleteAlbumAction($albumId, $artistSlug)
    {
        $albumsRepo = $this->getDoctrine()->getRepository("MusicBundle:Album");
        $album = $albumsRepo->find($albumId);

        if ($album) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($album);
            $em->flush();
        }

        $this->addFlash("success", "L'album a bien été supprimé !");
        return $this->redirectToRoute('list_albums', ["artistSlug" => $artistSlug]);
    }
}
