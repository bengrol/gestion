<?php

namespace Gestion\ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Clients
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ClientsBundle\Entity\ClientsRepository")
 */
class Clients
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
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable =true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable =true)
     * 
     * @Assert\Regex("/0[0-9]{9}/")
     */
    private $telephone;

    /**
     * @var string
     * @ORM\Column(name="portable", type="string", length=255, nullable =true)
     * 
     * @Assert\Regex("/0[0-9]{9}/")
     */
    private $portable;
    
    /**
     * @var integer
     * @ORM\Column(name="pointfidelite", type="integer", nullable =true)
     * 
     */
    private $pointFidelite;
   
    /**
     * @var string
     * @ORM\Column(name="mail", type="string", nullable =true)
     * 
     * @Assert\Regex("/[a-z1-9]{3,}@[a-z]{1}[a-z1-9]{2,}.[a-z]{2,}/")
     */
    private $mail;
   
    /**
     * @var date
     * @ORM\Column(name="datenaissance", type="date", nullable =true)
     * 
     */
    private $dateNaissance;

    
    
    /*------      ------*/
    
      /**
     * 
     * @ORM\OneToMany(targetEntity="Gestion\ArticlesBundle\Entity\Commandes", mappedBy="client", cascade={"persist", "all"})
     */
    private $listeCommande;
    
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="RendezVous", mappedBy="client", cascade={"persist", "all"})
     */
    private $rendezVous;
    


    public function __construct($nom)
    {
        $this->nom = $nom;
        
        $this->listeCommande = new ArrayCollection();
        $this->rendezVous = new ArrayCollection();
        
        $this->dateNaissance = null;
        
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
     * @return Clients
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
     * Set prenom
     *
     * @param string $prenom
     * @return Clients
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Clients
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set portable
     *
     * @param string $portable
     * @return Clients
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }

    /**
     * Get portable
     *
     * @return string 
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set listeCommande
     *
     * @param \stdClass $listeCommande
     * @return Clients
     */
    public function setListeCommande($listeCommande)
    {
        $this->listeCommande = $listeCommande;

        return $this;
    }
    
    /**
     * Set listeCommande
     *
     * @param \stdClass $listeCommande
     * @return Clients
     */
    public function addCommande($listeCommande)
    {
        $this->listeCommande->add($listeCommande);
        //$this->listeCommande->add('');
        
        return $this;
    }

    /**
     * Get listeCommande
     *
     * @return \stdClass 
     */
    public function getListeCommande()
    {
        return $this->listeCommande;
    }

    /**
     * Set rendezVous
     *
     * @param \stdClass $rendezVous
     * @return Clients
     */
    public function setRendezVous($rendezVous)
    {
        $this->rendezVous = $rendezVous;

        return $this;
    }

    /**
     * Get rendezVous
     *
     * @return \stdClass 
     */
    public function getRendezVous()
    {
        return $this->rendezVous;
    }
    
    
    public function getPointFidelite() {
        return $this->pointFidelite;
    }

    public function setPointFidelite($pointFidelite) {
        $this->pointFidelite = $pointFidelite;
    }

    
    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTime $dateNaissance = null) {
        
        $this->dateNaissance = $dateNaissance;
    }

   


}
