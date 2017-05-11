<?php

namespace MusicBundle\Controller;

use MusicBundle\Entity\Artist;
use MusicBundle\Form\ArtistType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{
    /**
     * Liste des artistes
     */
    public function listArtistsAction()
    {
        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artists = $artistsRepo->findBy([], ["id" => "ASC"], 30, 0);

        return $this->render('MusicBundle:Artist:list_artists.html.twig', [
            "artists" => $artists
        ]);
    }

    /**
     * Ajout d'artiste
     */
    public function addArtistAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($artist);
            $em->flush();

            $this->addFlash('success', "L'artiste a bien été créé !");
            return $this->redirectToRoute('list_artists');
        }

        return $this->render('MusicBundle:Artist:add_artist.html.twig', [
            "form" => $form->createView(),
            "artist" => $artist
        ]);
    }

    /**
     * Modification d'artiste
     */
    public function editArtistAction(Request $request, $artistSlug)
    {
        $em = $this->getDoctrine()->getManager();

        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artist = $artistsRepo->findOneBySlug($artistSlug);

        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($artist);
            $em->flush();

            $this->addFlash('success', "L'artiste a bien été modifié !");
            return $this->redirectToRoute('list_artists');
        }

        return $this->render('MusicBundle:Artist:edit_artist.html.twig', [
            "form" => $form->createView(),
            "artist" => $artist
        ]);
    }

    /**
     * Suppression d'artiste
     */
    public function deleteArtistAction($artistSlug)
    {
        $artistsRepo = $this->getDoctrine()->getRepository("MusicBundle:Artist");
        $artist = $artistsRepo->findOneBySlug($artistSlug);

        $em = $this->getDoctrine()->getManager();
        $em->remove($artist);
        $em->flush();

        $this->addFlash("success", "L'artiste a bien été supprimé !");
        return $this->redirectToRoute('list_artists');
    }
}
