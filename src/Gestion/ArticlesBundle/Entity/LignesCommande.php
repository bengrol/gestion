<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gestion\ArticlesBundle\Entity\Commandes ;
use Gestion\ArticlesBundle\Entity\Articles;

/**
 * LignesCommande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\LignesCommandeRepository")
 */
class LignesCommande 
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
     * @var float
     *
     * @ORM\Column(name="prixHt", type="float", nullable=true)
     */
    private $prixHt;
    
    
     /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", nullable=true)
     */
    private $tva;

    /**
     *
     * @var text
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

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
    
    
    /**
     * @var text
     * @ORM\Column(name="designation", type="text",  nullable=true)
     */
    private $designation;

    

    /* ----------------    ----------------*/
    /**
     * @ORM\ManyToOne(targetEntity="Articles", inversedBy="ligneCommande")
     * 
     */
    private $article;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Gestion\ClientsBundle\Entity\User", inversedBy="lignecmd", cascade={"persist", "merge"})
     */
    private $salarie;


    /**
     * 
     * @ORM\ManyToOne(targetEntity="Commandes", inversedBy="lignesCommandes", 
     * cascade={"persist", "merge"})
     * 
     */
    private $commande; 
    
    
    function __construct(Articles $article,Commandes $commande, $salarie, $detail = null ) {
        $this->prixHt = $article->getPrixHt();
        $this->tva = $article->getTaxe()->getTaux();
        $this->technique = $article->isTechnique();
        $this->designation = $article->getDesignation() ;
        $this->editable = $article->getEditable();
        $this->article = $article;
        $this->commande = $commande;
        $this->salarie = $salarie;
        $this->detail = $detail;
        
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
     * Set prixHt
     *
     * @param float $prixHt
     * @return LignesCommande
     */
    public function setPrixHt($prixHt)
    {
        $listToreplace = array(',' );
        
        $this->prixHt = str_replace($listToreplace, '.', $prixHt);

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
     * Set tva
     *
     * @param float $tva
     * @return LignesCommande
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
    }

   
    /**
     * Set commande
     *
     * @param \stdClass $commande
     * @return LignesCommande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande->getId();

        return $this;
    }

    /**
     * Get commande
     *
     * @return \stdClass 
     */
    public function getCommande()
    {
        return $this->commande;
    }
    
    
    public function getTTC(){
        return $this->getPrixHt() * ($this->getTva()/100+1);
        
    }
    
    
    public function getArticle() {
        return $this->article;
    }

    public function setArticle($article) {
        $this->article = $article;
    }

    
    public function getSalarie() {
        return $this->salarie;
    }

    public function setSalarie($salarie) {
        $this->salarie = $salarie;
    }


    public function getDetail() {
        return $this->detail;
    }

    public function setDetail( $detail) {
        $this->detail = $detail;
    }


    
    public function getTechnique() {
        return $this->technique;
    }

    public function setTechnique($technique) {
        $this->technique = $technique;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function setDesignation( $designation) {
        $this->designation = $designation;
    }

    
    public function getEditable() {
        return $this->editable;
    }

    public function setEditable($editable) {
        $this->editable = $editable;
    }



}
