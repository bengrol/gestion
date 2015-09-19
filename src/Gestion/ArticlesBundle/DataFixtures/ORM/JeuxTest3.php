<?php
namespace Gestion\ArticlesBundle\DataFixtures\ORM ; 

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gestion\ArticlesBundle\Entity\Commandes;
use Gestion\ArticlesBundle\Entity\Paiements;
use Gestion\ArticlesBundle\Entity\LignesCommande;


class JeuxTest3 extends AbstractFixture implements OrderedFixtureInterface{
    
    
    
    public function load(ObjectManager $manager) {
        
       $topersist = array();
        
        //get clients 
        $client1 = $this->getReference("Lebowski");
        $client2 = $this->getReference("Wolf");
        $client3 = $this->getReference("BOB");
        $client4 = $this->getReference("Rivera");
        
        
        //get salaries
        $sal1 = $this->getReference("nat");
        $sal2 = $this->getReference("sylvie");
       
        // get articles  $nom, $prixHt, $taxe, $categorie
       $art1 = $this->getReference("coupe homme classic");
       $art2 = $this->getReference("coupe femme classic");
       $art3 = $this->getReference("coupe enfant classic");
       $couleur_tech = $this->getReference("Couleur");

       // create commandes
       $cmdClient1 = new Commandes($client1);
       //$cmdClient1->setRemise(5);
       $cmdClient2 = new Commandes($client1);
       $cmdClient3 = new Commandes($client1);
       $cmdClient4 = new Commandes($client2);
       $cmdClient5 = new Commandes($client3);
       $cmdClient6 = new Commandes($client4);
       
       
       $cmdClient1->isSolde(false) ;
       $cmdClient2->isSolde(false);
       $cmdClient3->isSolde(false);
       $cmdClient4->isSolde(false);
       $cmdClient5->isSolde(false);
       $cmdClient6->isSolde(false);
        
       $this->addReference('cmdClient1', $cmdClient1);
       $this->addReference('cmdClient2', $cmdClient4);
       $this->addReference('cmdClient3', $cmdClient5);
       
       array_push($topersist,$cmdClient1,$cmdClient4,$cmdClient5,$cmdClient6);
        

       
        // create ligne de commandes 
        $lg1_1 = new LignesCommande($couleur_tech, $cmdClient1, $sal1, 'test detail tech');
        $lg1_1->setTechnique(true);
        $lg1_2 = new LignesCommande($art2, $cmdClient1, $sal2);
        $lg2_1 = new LignesCommande($art2, $cmdClient2 , $sal1);
        $lg2_2 = new LignesCommande($art3, $cmdClient2 , $sal2);
        $lg3_1 = new LignesCommande($art2, $cmdClient3 , $sal1);
        
        $lg4_1 = new LignesCommande($art1, $cmdClient4, $sal2);
        $lg5_1 = new LignesCommande($art2, $cmdClient5 , $sal1);
       // $lg6_1 = new LignesCommande($art3, $cmdClient6);
        
        array_push($topersist, $lg1_1, $lg1_2, $lg2_1, $lg2_2,  $lg3_1, $lg4_1, $lg5_1 );
    //    array_push($topersist, $lg1_1, $lg1_2, $lg3_1, $lg4_1, $lg5_1, $lg6_1 );
        
        
        $espece = $this->getReference("Espece");
        $cb = $this->getReference("CarteBleue");
        $cheque = $this->getReference("Cheque");
     
        
        // $montant, Commandes $commande, MoyensPaiement $moyenPaiement , Salaries $salarie
        $pm1_1 = new Paiements(100, $cmdClient1, $espece, $sal1);
        $pm1_2 = new Paiements(20, $cmdClient1, $cb, $sal2);
        $pm2_1 = new Paiements(30, $cmdClient2, $cheque, $sal1);
        $pm6_1 = new Paiements(30, $cmdClient6, $cheque, $sal2);
        
        
        
        
        
        
        array_push($topersist, $pm1_1, $pm1_2, $pm2_1, $pm6_1);
        
         foreach ($topersist as $value) {
            $manager->persist($value);
           
        }
        $manager->flush();
    }

    
    public function getOrder() {
        return 3;
    }

}
