<?php
namespace Gestion\ArticlesBundle\DataFixtures\ORM ; 

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gestion\ClientsBundle\Entity\RendezVous ;

class JeuxTest4 extends AbstractFixture implements OrderedFixtureInterface{
    
    
    
    public function load(ObjectManager $manager) {
        
       $topersist = array();
        
       
       /* --- Creation de rendez vous ---*/
       
        //creation clients 
        $client1 = $this->getReference("Lebowski");
        $client2 = $this->getReference("Wolf");
        $client3 = $this->getReference("BOB");
        $client4 = $this->getReference("Rivera");
        
       
        //get salaries
        $sal1 = $this->getReference("nat");
        $sal2 = $this->getReference("sylvie");

        $now = new \DateTime('NOW');
        
        $rdv1 = new RendezVous($now,  $now->add(new \DateInterval('PT1H')), $client1, $sal1 );
        
       array_push($topersist, $rdv1);
       
       
       
       
       /* --- Creation de rendez vous ---*/
       
       
         foreach ($topersist as $value) {
            $manager->persist($value);
           
        }
        $manager->flush();
    }

    
    public function getOrder() {
        return 4;
    }

}
