<?php

namespace Gestion\ArticlesBundle\Tests\Entity ;

use Gestion\ClientsBundle\Entity\Clients ;
use Gestion\ArticlesBundle\Entity\Commandes ;

class CommandeTest extends \PHPUnit_Framework_TestCase{
    
    private $chaineTest = "article";
    
    
    public function testNom() {
        $client = new Clients();
        $this->assertInstanceOf('Gestion\ClientsBundle\Entity\Clients', $client );
        
        $commande = new Commandes($client);
        $this->assertInstanceOf('Gestion\ArticlesBundle\Entity\Commandes', $commande );
        
        $this->assertInstanceOf('\DateTime', $commande->getDateCmd() );
    }
    
    
    public function configTest(){
        $client = new Clients();
        $client->setNom($this->chaineTest);
        return $client;
    }
    
    
}
