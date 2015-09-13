<?php

namespace Gestion\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MoyensPaiement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ArticlesBundle\Entity\MoyensPaiementRepository")
 */
class MoyensPaiement
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
     * @ORM\OneToMany(targetEntity="Paiements", mappedBy="moyenPaiement")
     */
     private $paiement;
     
    
     function __construct($nom) {
         $this->nom = $nom;
          $this->paiement = new ArrayCollection();
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
     * @return MoyensPaiement
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
     * Set paiement
     *
     * @param \stdClass $paiement
     * @return MoyensPaiement
     */
    public function setPaiement($paiement)
    {
        array_push($this->paiement, $paiement);

        return $this;
    }

    /**
     * Get paiement
     *
     * @return \stdClass 
     */
    public function getPaiement()
    {
        return $this->paiement;
    }
}
