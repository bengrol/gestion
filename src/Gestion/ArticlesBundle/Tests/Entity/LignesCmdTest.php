<?php

namespace Gestion\ArticlesBundle\Tests\Entity ;

use Gestion\ArticlesBundle\Entity\Articles ;
use Gestion\ArticlesBundle\Entity\Commandes ;
use Gestion\ArticlesBundle\Entity\LignesCommande ;
use Gestion\ClientsBundle\Entity\Clients ;

class LignesCmdTest extends \PHPUnit_Framework_TestCase{
    
    private $chaineTest = "article";
    
    
    public function testNom() {
        $client = new Clients('test');
        $commande = new Commandes($client);
        
        $article = new Articles();
        
        $lgCmd = new LignesCommande( $article, $commande);
        
        
        $this->assertInstanceOf('Gestion\ArticlesBundle\Entity\LignesCommande', $lgCmd );
        
        
    }
    
    
    public function configTest(){
        $article = new Articles();
        $article->setNom($this->chaineTest);
        return $article;
    }
    
    
}
