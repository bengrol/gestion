<?php

namespace Gestion\ArticlesBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of LignesCommande
 *
 * @author macboook
 */
class LignesCommande extends WebTestCase{
    
    
        /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }
    
    
    
    
        public function testSearchByCategoryName()
    {
            
            $client = $this->em->getRepository('GestionClientsBundle:Clients')->find(219);
            
            echo($client->getClassName());
            die();
            
        $products = $this->em
            ->getRepository('GestionClientsBundle:Clients')
            ->getLgnCmdTechByClient($client->getId())
        ;

        $this->assertInstanceOf( 'array', $products);
    }
    
    
}
