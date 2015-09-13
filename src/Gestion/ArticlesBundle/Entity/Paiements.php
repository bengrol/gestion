<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gestion\ArticlesBundle\Entity\MoyensPaiement ;

/**
 * Paiements
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\PaiementsRepository")
 */
class Paiements
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
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

    /**
     * @var \DateTime
     *@ORM\Column(name="datePaiement", type="datetime")
     */
    private $datePaiement;
    
    /**
     * @var boolean
     * @ORM\Column(name="active", type="boolean")
     * 
     */
    private $active;
    
    
    
    /* ----------------    ----------------*/
     /**
     *  
     * @ORM\ManyToOne(targetEntity="Gestion\ClientsBundle\Entity\User",
     *  inversedBy="paiements", cascade={"persist", "merge"} )
     */
    private $salarie;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Commandes", inversedBy="paiement")
     */
    private $commande;
    
    
    /**
     *  @ORM\ManyToOne(targetEntity="MoyensPaiement", inversedBy="paiement")
     */
    private $moyenPaiement;


    function __construct($montant, Commandes $commande, MoyensPaiement $moyenPaiement) {
        $this->montant = $montant;
        $this->datePaiement = new \DateTime('NOW');
        $this->commande = $commande;
        $this->moyenPaiement = $moyenPaiement;
        $this->setActive(TRUE);
        
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
     * Set montant
     *
     * @param float $montant
     * @return Paiements
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set datePaiement
     *
     * @param \DateTime $datePaiement
     * @return Paiements
     */
    public function setDatePaiement($datePaiement)
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    /**
     * Get datePaiement
     *
     * @return \DateTime 
     */
    public function getDatePaiement()
    {
        return $this->datePaiement;
    }

    /**
     * Set commande
     *
     * @param \stdClass $commande
     * @return Paiements
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;

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

    /**
     * Set moyenPaiement
     *
     * @param \stdClass $moyenPaiement
     * @return Paiements
     */
    public function setMoyenPaiement($moyenPaiement)
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    /**
     * Get moyenPaiement
     *
     * @return \stdClass 
     */
    public function getMoyenPaiement()
    {
        return $this->moyenPaiement;
    }
    
    
    
    public function getActive() {
        return $this->active;
    }

 
    public function getSalarie() {
        return $this->salarie;
    }

    public function setActive($active) {
        $this->active = $active;
    }


    public function setSalarie($salarie) {
        $this->salarie = $salarie;
    }


}
