<?php

namespace Gestion\ClientsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gestion\ClientsBundle\Entity\User ;
/**
 * RendezVous
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\ClientsBundle\Entity\RendezVousRepository")
 */
class RendezVous
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurefin", type="datetime")
     */
    private $heureFin;

    
    
    
    /*------      ------*/
    /**
     * @ORM\ManyToOne(targetEntity="Clients", inversedBy="rendezVous")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rendezVous" )
     */
    private $salarie;


    function __construct(\DateTime $date,  \DateTime $heureFin, $client,  User $salarie) {
        $this->date = $date;
        $this->heureFin = $heureFin;
        $this->client = $client;
        $this->salarie = $salarie;
        
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
     * Set date
     *
     * @param \DateTime $date
     * @return RendezVous
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     * @return RendezVous
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set client
     *
     * @param \stdClass $client
     * @return RendezVous
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

    /**
     * Set salarie
     *
     * @param \stdClass $salarie
     * @return RendezVous
     */
    public function setSalarie($salarie)
    {
        $this->salarie = $salarie;

        return $this;
    }

    /**
     * Get salarie
     *
     * @return \stdClass 
     */
    public function getSalarie()
    {
        return $this->salarie;
    }
}
