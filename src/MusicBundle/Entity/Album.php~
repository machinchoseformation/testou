<?php

namespace MusicBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="MusicBundle\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;


    /**
     * @var \MusicBundle\Entity\Artist
     *
     * @ORM\ManyToOne(targetEntity="\MusicBundle\Entity\Artist", inversedBy="albums")
     */
    private $artist;

    /**
     * @var ArrayCollection  Contient les albums de cet artiste
     *
     * @ORM\OneToMany(targetEntity="\MusicBundle\Entity\Song", mappedBy="album", cascade={"remove"})
     */
    private $songs;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="\MusicBundle\Entity\Tag", inversedBy="albums")
     */
    private $tags;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Album
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set artist
     *
     * @param \MusicBundle\Entity\Artist $artist
     * @return Album
     */
    public function setArtist(\MusicBundle\Entity\Artist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \MusicBundle\Entity\Artist 
     */
    public function getArtist()
    {
        return $this->artist;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->songs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add songs
     *
     * @param \MusicBundle\Entity\Song $songs
     * @return Album
     */
    public function addSong(\MusicBundle\Entity\Song $songs)
    {
        $this->songs[] = $songs;

        return $this;
    }

    /**
     * Remove songs
     *
     * @param \MusicBundle\Entity\Song $songs
     */
    public function removeSong(\MusicBundle\Entity\Song $songs)
    {
        $this->songs->removeElement($songs);
    }

    /**
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * Add tags
     *
     * @param \MusicBundle\Entity\Tag $tags
     * @return Album
     */
    public function addTag(\MusicBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \MusicBundle\Entity\Tag $tags
     */
    public function removeTag(\MusicBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
