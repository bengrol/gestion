<?php

namespace Gestion\ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * Salaries
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Gestion\ClientsBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
   // protected $mail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
   // protected $username;
    
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
   // protected $roles;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
   // protected $password;
    
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
  //  protected $salt;
    
    
    /*------      ------*/
    
    
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Gestion\ArticlesBundle\Entity\LignesCommande", mappedBy="salarie" , cascade={"persist", "all"})
     */
    private $lignecmd;
    
    /**
     * @ORM\OneToMany(targetEntity="RendezVous", mappedBy="salarie")
     * 
     */
    private $rendezVous;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="Gestion\ArticlesBundle\Entity\Paiements" ,
     *  mappedBy="salarie" , cascade={"persist", "all"})
     * 
     */
    private $paiements;
    
    function __construct() {
        parent::__construct();
        
        $this->nom = $this->username;
        $this->rendezVous = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->lignecmd = new ArrayCollection();
        
        
        // De base, on va attribuer au nouveau utilisateur, le rôle « ROLE_USER »
        //$this->roles = array("ROLE_USER");
       
        
       // $this->email =  $nom.'@test.com';
        //$this->username = substr($nom, 0, 3);
        //$this->password = 'test';
        
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
     * Set rendezVous
     *
     * @param \stdClass $rendezVous
     * @return User
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
    
    
    public function getCommandes() {
        return $this->commandes;
    }

    public function setCommandes($commandes) {
        $this->commandes = $commandes;
    }
    
    public function getLignecmd() {
        return $this->lignecmd;
    }

    public function setLignecmd($lignecmd) {
        $this->lignecmd = $lignecmd;
    }

    
    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
        
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getNom(){
        return $this->username;
    }
}
