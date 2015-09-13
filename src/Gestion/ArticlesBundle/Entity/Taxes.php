<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Taxes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\TaxesRepository")
 */
class Taxes
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
     * @var float
     *
     * @ORM\Column(name="taux", type="float")
     * 
     */
    private $taux;
    
        
    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultTaxe", type="boolean")
     */
    private $default;
    
   
    /**
     *@var type ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Articles", mappedBy="taxe")
     * 
     */
    private $article;

    
    function __construct($nom, $taux) {
        $this->nom = $nom;
        $this->taux = $taux;
        
        $this->article = new ArrayCollection();
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
     * @return Taxes
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

    /**
     * Set taux
     *
     * @param float $taux
     * @return Taxes
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return float 
     */
    public function getTaux()
    {
        return $this->taux;
    }

   
    
    
    public function isDefault() {
        return $this->default;
    }

    public function setDefault($default) {
        
        $this->default = $default;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle(Articles $article) {
        array_push($this->article,  $article);
    }




}
