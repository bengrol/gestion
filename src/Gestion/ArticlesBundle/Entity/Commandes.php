<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gestion\ClientsBundle\Entity\Clients;



/**
 * Commandes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\CommandesRepository")
 */
class Commandes
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCmd", type="datetime")
     */
    private $dateCmd;
    
    /**
     * @ORM\Column(name="solde", type="boolean")
     * 
     */
    private $solde;
    
    

    /* ----------------    ----------------*/
    
    /**
     * @ORM\ManyToOne(targetEntity="Gestion\ClientsBundle\Entity\Clients",
     *  inversedBy="listeCommande", cascade={"persist", "merge"} )
     * 
     */
    private $client;
    
    /**
     * @ORM\OneToMany(targetEntity="LignesCommande", mappedBy="commande", cascade={"persist", "all"})
     */
    private $lignesCommandes;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Paiements", mappedBy="commande" , cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="paiement_id", referencedColumnName="id")
     */
    private $paiement;
    
  
    
 
    
    public function __construct(Clients $client)
    {
        $this->client = $client;
        $this->dateCmd = new \DateTime('NOW'); 
        $this->lignesCommandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->paiement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solde = FALSE;
        
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
     * Set dateCmd
     *
     * @param \DateTime $dateCmd
     * @return Commandes
     */
    public function setDateCmd($dateCmd)
    {
        $this->dateCmd = $dateCmd;

        return $this;
    }

    /**
     * Get dateCmd
     *
     * @return \DateTime 
     */
    public function getDateCmd()
    {
        return $this->dateCmd;
    }


    /**
     * Set client
     *
     * @param \stdClass $client
     * @return Commandes
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \stdClass 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    
    public function getLignesCommandes() {
        return $this->lignesCommandes;
    }

    

    public function setLignesCommandes($lignesCommandes) {
        $this->lignesCommandes = $lignesCommandes;
    }

    
    
    
    public function getPaiement() {
        return $this->paiement;
    }
    
    
    public function setPaiement($paiement) {
        $this->paiement = $paiement;
    }
    
    
    
    public function setSolde($solde) {
        return $this->solde = $solde;
    }

    public function isSolde() {
        return $this->solde ;
    }

    public function getMontantTTC(){
        $montant =0;
        foreach ($this->getLignesCommandes() as $commande) {
            $montant += $commande->getTTC();
        }
        
        
        
       return $montant;
       
    }
    public function getTotalPaiement(){
        $montant =0;
        foreach ($this->getPaiement() as $value) {
            $montant += $value->getMontant();
        }
        
       return $montant;
       
    }
    
    public function setSoldeByAfterPaiement() {
        if($this->getMontantTTC()<= $this->getTotalPaiement()){
            $this->setSolde(true);
            
            
        }else{
            $this->setSolde(false);
            
        }
        
    }
    

   

}
