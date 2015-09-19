<?php
namespace Gestion\ArticlesBundle\DataFixtures\ORM ; 

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gestion\ArticlesBundle\Entity\Taxes ;
use Gestion\ArticlesBundle\Entity\Categories ;
use Gestion\ArticlesBundle\Entity\MoyensPaiement ;

class JeuxTest1 extends AbstractFixture implements OrderedFixtureInterface{
    
    
    
    public function load(ObjectManager $manager) {
        
        $topersist = array();

        $t1 = new Taxes("Taxe20", 20);
        $t1->setDefault(true);


        array_push($topersist,$t1);


        //creation categorie produits
        $catHomme = new Categories("Homme");
        $catFemme = new Categories("Femme");
        $catEnfant = new Categories("Enfant et Ado");
        $catProduit = new Categories("Produit");
        
        array_push($topersist, $catHomme, $catFemme, $catEnfant, $catProduit); 
       
        //creation moyens paiement
        $espece = new MoyensPaiement("Espece");
        $espece->setNom("Espece");
        $cb = new MoyensPaiement("CarteBleue");
        $cheque = new MoyensPaiement("Cheque");
        
        array_push($topersist,$espece, $cheque, $cb);
         
        
        
        foreach ($topersist as $value) {
            $manager->persist($value);
            $this->addReference($value->getNom(), $value);
        }
        $manager->flush();
    }

    
    public function getOrder() {
        return 1;
    }

}
