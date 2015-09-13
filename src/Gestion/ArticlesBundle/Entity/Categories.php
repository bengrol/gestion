<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Categories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\CategoriesRepository")
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="Articles", mappedBy="categorie")
     */
    private $article;

    /**
     * @param type $nom
     */
    function __construct( $nom) {
        $this->nom = $nom;
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setSlug();
    }

    

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
     * Set nom
     *
     * @param string $nom
     * @return Categories
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    
    
    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article) {
        $this->article = $article;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug() {
        $listToreplace = array(' ', '  ',  '-', '/', '(', ')', ',', '&', '__' );
        $this->slug = str_replace($listToreplace, "_", $this->nom);
    }


    
}
