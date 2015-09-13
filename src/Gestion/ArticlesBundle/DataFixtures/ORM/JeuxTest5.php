<?php
namespace Gestion\ArticlesBundle\DataFixtures\ORM ; 

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gestion\ClientsBundle\Entity\Clients ;


class JeuxTest5 extends AbstractFixture implements OrderedFixtureInterface{
    
    
    
    public function load(ObjectManager $manager) {
        
       $topersist = array();
       $cmdClient1 = $this->getReference("cmdClient1");
       $cmdClient1->setSoldeByAfterPaiement();
       
       
       //$cmdClient3 = $this->getReference("cmdClient3");
       
      // $manager->remove($cmdClient3);
       
       
       
       
       /* --- Creation de rendez vous ---*/
       
        array_push($topersist, $cmdClient1 );
       

$tableauClient = array(
	array("nom"=>"Maris","prenom"=>"Colby","telephone"=>"0833 48 70 98","portable"=>"08 62 18 07 95"),
	array("nom"=>"Anastasia","prenom"=>"Alyssa","telephone"=>"09 91 36 87 92","portable"=>"01 76 18 82 98"),
	array("nom"=>"Dakota","prenom"=>"Vanna","telephone"=>"04 74 94 37 35","portable"=>"09 11 47 94 63"),
	array("nom"=>"Mona","prenom"=>"Raya","telephone"=>"05 47 33 10 23","portable"=>"05 20 65 28 84"),
	array("nom"=>"Hamish","prenom"=>"Kasimir","telephone"=>"09 60 80 19 94","portable"=>"05 06 19 93 28"),
	array("nom"=>"Raymond","prenom"=>"Ulla","telephone"=>"01 15 02 13 83","portable"=>"06 89 35 75 10"),
	array("nom"=>"Preston","prenom"=>"Natalie","telephone"=>"03 35 75 62 26","portable"=>"06 93 35 05 88"),
	array("nom"=>"Vanna","prenom"=>"Sonya","telephone"=>"05 65 29 68 71","portable"=>"03 41 27 43 53"),
	array("nom"=>"Hector","prenom"=>"Jackson","telephone"=>"02 46 69 39 28","portable"=>"05 59 72 10 96"),
	array("nom"=>"Trevor","prenom"=>"Clio","telephone"=>"05 60 94 94 20","portable"=>"02 61 67 38 06"),
	array("nom"=>"Alisa","prenom"=>"Mira","telephone"=>"04 56 89 50 69","portable"=>"09 31 23 32 15"),
	array("nom"=>"Cecilia","prenom"=>"India","telephone"=>"07 08 49 57 34","portable"=>"08 48 19 15 00"),
	array("nom"=>"Asher","prenom"=>"Ima","telephone"=>"01 51 65 37 08","portable"=>"05 61 98 83 91"),
	array("nom"=>"Sasha","prenom"=>"Dana","telephone"=>"06 46 62 31 14","portable"=>"05 38 71 92 01"),
	array("nom"=>"Jessamine","prenom"=>"Xander","telephone"=>"06 72 65 04 91","portable"=>"06 30 02 01 84"),
	array("nom"=>"Shoshana","prenom"=>"Hunter","telephone"=>"08 03 61 80 68","portable"=>"02 52 25 42 56"),
	array("nom"=>"Freya","prenom"=>"Zia","telephone"=>"06 68 91 62 52","portable"=>"08 68 06 06 76"),
	array("nom"=>"Georgia","prenom"=>"Autumn","telephone"=>"02 71 05 25 44","portable"=>"04 50 90 19 70"),
	array("nom"=>"Jana","prenom"=>"Avye","telephone"=>"09 58 37 52 82","portable"=>"04 80 07 45 56"),
	array("nom"=>"Oren","prenom"=>"Gabriel","telephone"=>"04 70 74 45 78","portable"=>"05 96 77 51 98"),
	array("nom"=>"Wing","prenom"=>"Dacey","telephone"=>"06 32 89 87 21","portable"=>"04 18 42 61 07"),
	array("nom"=>"Kibo","prenom"=>"Vera","telephone"=>"02 37 05 53 65","portable"=>"02 58 23 00 52"),
	array("nom"=>"Gretchen","prenom"=>"Nola","telephone"=>"02 82 28 81 07","portable"=>"02 77 75 80 81"),
	array("nom"=>"Ian","prenom"=>"Erica","telephone"=>"03 83 88 45 04","portable"=>"09 68 95 54 72"),
	array("nom"=>"Wyoming","prenom"=>"Dylan","telephone"=>"05 55 30 86 81","portable"=>"03 84 34 17 85"),
	array("nom"=>"Dante","prenom"=>"Zachary","telephone"=>"06 72 13 37 56","portable"=>"06 70 55 36 05"),
	array("nom"=>"Chantale","prenom"=>"Oleg","telephone"=>"07 61 60 65 26","portable"=>"02 14 41 05 28"),
	array("nom"=>"Daphne","prenom"=>"Xaviera","telephone"=>"04 41 83 46 30","portable"=>"06 22 94 92 84"),
	array("nom"=>"Maris","prenom"=>"Farrah","telephone"=>"05 13 42 36 26","portable"=>"06 02 42 37 41"),
	
);


        
        $tabObClient = array();
        
        foreach($tableauClient as $ligneClient){
            
            $ob=   new Clients($ligneClient['nom']);
             $ob->setPrenom($ligneClient['prenom']);
             $ob->setTelephone(str_replace(" ","", $ligneClient['telephone']));
             $ob->setPortable(str_replace(" ","", $ligneClient['portable']));
             
             $ob->setMail($ligneClient['prenom']."@".$ligneClient['nom'].".com");
             $dateN = rand(1942, 1989).'-'.rand(1, 12).'-'.rand(1, 27);
             
             $dateT = new \DateTime($dateN);
             $ob->setDateNaissance($dateT);
             
             $ob->setPointFidelite(rand(1, 12));
            
            $manager->persist($ob);
            
        }
        
        
        
     
        
        
        
       
       
         foreach ($topersist as $value) {
            $manager->persist($value);
           
        }
        $manager->flush();
    }

    
    public function getOrder() {
        return 5;
    }

}
