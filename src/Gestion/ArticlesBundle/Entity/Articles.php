<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Articles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\ArticlesRepository")
 */
class Articles
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var text
     * @ORM\Column(name="designation", type="text",  nullable=true)
     */
    private $designation;

    /**
     * @var float
     * @ORM\Column(name="prixHt", type="float", scale=2,   nullable=true)
     */
    private $prixHt;
    
    /**
     *
     * @var boolean
     * @ORM\Column(name="technique", type="boolean") 
     */
    private $technique;

    /**
     *
     * @var boolean
     * @ORM\Column(name="editable", type="boolean") 
     */
    private $editable;

    
    /* ----------------    ----------------*/
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Taxes", inversedBy="article")
     * @ORM\JoinColumn(name="taxe_id", referencedColumnName="id", nullable=true)
     * 
     */
    private $taxe;
      
    
    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="article")
     * @ORM\JoinColumn(name="cate_id", referencedColumnName="id")
     */
    private $categorie;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="LignesCommande", mappedBy="article")
     */
    private $ligneCommande;
    
    /**
     * 
     * @param type string $nom
     * @param type float $prixHt
     * @param type Taxes $taxe
     * @param type Categorie $categorie
     */
    function __construct($nom, $prixHt, $taxe, $categorie, $tech = false, $edit = false) {
        $this->nom = $nom;
        $this->editable = $edit;
        $this->prixHt = $prixHt;
        $this->taxe = $taxe;
        $this->categorie = $categorie;
        $this->ligneCommande = new ArrayCollection();
        $this->technique = $tech;
    }

    public function getLigneCommande() {
        return $this->ligneCommande;
    }

    public function setLigneCommande($ligneCommande) {
        $this->ligneCommande = $ligneCommande;
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
     * @return Articles
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
     * Set designation
     *
     * @param string $designation
     * @return Articles
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set prixHt
     *
     * @param float $prixHt
     * @return Articles
     */
    public function setPrixHt($prixHt)
    {
        
        $this->prixHt =  $prixHt;

        return $this;
    }

    /**
     * Get prixHt
     *
     * @return float 
     */
    public function getPrixHt()
    {
        return $this->prixHt;
    }

    /**
     * Set taxe
     *
     * @param \stdClass $taxe
     * @return Articles
     */
    public function setTaxe($taxe)
    {
        $this->taxe = $taxe;

        return $this;
    }

    /**
     * Get taxe
     *
     * @return \stdClass 
     */
    public function getTaxe()
    {
        return $this->taxe;
    }

    /**
     * Set categorie
     *
     * @param \stdClass $categorie
     * @return Articles
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \stdClass 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    
    
    
    public function isTechnique() {
        return $this->technique;
    }

    public function setTechnique($technique) {
        $this->technique = $technique;
    }

   
    public function getEditable() {
        return $this->editable;
    }

    public function setEditable($editable) {
        $this->editable = $editable;
    }

    
    
}
