<?php
namespace Gestion\ArticlesBundle\DataFixtures\ORM ; 

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gestion\ClientsBundle\Entity\Clients ;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Gestion\ClientsBundle\Entity\User ;
use Gestion\ArticlesBundle\Entity\Articles ;



class JeuxTest2 extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{
    
     /**
     * @var ContainerInterface
     */
    private $container;
    
    
        public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    
    public function load(ObjectManager $manager) {
        
        $topersist = array();
        
        
        
        $nat = array('nat', 'test', 'nathalie@test.com');
        $pat = array('sylvie', 'test', 'Patricia@test.com');
        
        $sal1 = $this->container->get('fos_user.util.user_manipulator')
                ->create($nat[0], $nat[1], $nat[2], 1, 0);
        $sal1->setRoles(array('ROLE_ADMIN'));
        
        $sal2 = $this->container->get('fos_user.util.user_manipulator')
                ->create($pat[0], $pat[1], $pat[2], 1, 0);
        $sal2->setRoles(array('ROLE_SALARIE'));
        
        $this->addReference($sal1->getUsername(), $sal1);
        $this->addReference($sal2->getUsername(), $sal2);
        array_push($topersist,$sal1, $sal2);
        
        
        //creation clients 
        $client1 = new Clients("Lebowski");
            $client1->setPrenom("big")
                    ->setPortable("0785342312")->setTelephone("0243121212");
            
        $client2 = new Clients("Wolf");
            $client2->setPrenom("Dane")
                    ->setPortable("0556582273")->setTelephone("0731958913");
            
        $client3 = new Clients("BOB");
            $client3->setPrenom("Courtney")
                    ->setPortable("0886128101")->setTelephone("0461895261");
        
            
        $client4 = new Clients("Rivera");
            $client4->setPrenom("Ramona")
                    ->setPortable("0685093768")->setTelephone("0674328979");

       array_push($topersist,$client1,$client2, $client3, $client4);
        $this->addReference($client1->getNom(), $client1);
        $this->addReference($client2->getNom(), $client2);
        $this->addReference($client3->getNom(), $client3);
        $this->addReference($client4->getNom(), $client4);
       
       $Taxe20 = $this->getReference("Taxe20");
       
       $catHomme = $this->getReference("Homme");
       $catFemme = $this->getReference("Femme");
       $catEnfant = $this->getReference("EnfantAdo");
       $catProd = $this->getReference("Produit");
       
       
       
       
       $listeArticleHomme = array(
           array('nom' => 'forf sh cp coif' , 'tarif' =>13.33 ),
array('nom' => 'forf cp coif' , 'tarif' =>10.83 ),
array('nom' => 'forf sh couronne coif' , 'tarif' =>10.83 ),
array('nom' => 'forf Sh cp coif rasage trad' , 'tarif' =>25 ),
array('nom' => 'forf Sh cp coif taille au rasoir' , 'tarif' =>25 ),
array('nom' => 'forf Sh cp coif rasage design' , 'tarif' =>29.17 ),

array('nom' => 'cp couronne' , 'tarif' =>7.5 ),
array('nom' => 'permanente homme' , 'tarif' =>15.83 ),
array('nom' => 'couleur homme' , 'tarif' =>17.5 ),

array('nom' => 'Rasage trad à l\'ancienne (cp choux)' , 'tarif' =>13.33 ),
array('nom' => 'Rasage design' , 'tarif' =>17.5 ),
array('nom' => 'entretien tracer de barbe (-12 jours)' , 'tarif' =>10.83 ),
array('nom' => 'taille barbe au rasoir' , 'tarif' =>12.5 ),
array('nom' => 'taille barbe aux ciseaux' , 'tarif' =>5.83 ),
array('nom' => 'taille barbe tondeuse' , 'tarif' =>4.17 ),
array('nom' => 'taille moustache' , 'tarif' =>2.5 ),
        );
       
       
       
       $listeArticleFemme = array(
           array('nom' => 'forf sh cp brushing ou mise en plis' , 'tarif' =>19.17 ),
array('nom' => 'forf sh brushing ou mp' , 'tarif' =>12.5 ),

array('nom' => 'supp longueur' , 'tarif' =>4.17 ),
array('nom' => 'soin' , 'tarif' =>4.17 ),
array('nom' => 'mousse' , 'tarif' =>4.17 ),
array('nom' => 'couleur à partir de' , 'tarif' =>19.17 ),
array('nom' => 'permanente à partie de' , 'tarif' =>20 ),
array('nom' => 'mèches à partir de' , 'tarif' =>21.67 ),
array('nom' => 'flash' , 'tarif' =>12.5 ),
array('nom' => 'décoloration à partir de' , 'tarif' =>20.83 ),
array('nom' => 'décapage à partir de' , 'tarif' =>16.67 ),
array('nom' => 'chignon banane' , 'tarif' =>23.33 ),
array('nom' => 'chignon +' , 'tarif' =>27.5 ),
array('nom' => 'chignon ++' , 'tarif' =>31.67 ),
array('nom' => 'forfait mariage ( 2 essais + le jour j )' , 'tarif' =>78.33 ),
array('nom' => 'forfait mariage ( 1 essai + le jour j )' , 'tarif' =>58.33 ),
array('nom' => 'tresse à partir de ' , 'tarif' =>14.17 )
        );
       
       
       $listeArticleEnfant = array(
           array('nom' => 'sh coupe coif -14' , 'tarif' =>11.67 ),
           array('nom' => 'sh coupe coif fille -18' , 'tarif' =>15 ),
           array('nom' => 'coupe bébé' , 'tarif' =>7.5 ),
           array('nom' => 'coupe enfant' , 'tarif' =>10 )

       );
       
       
       
       foreach ($listeArticleEnfant as  $value) {
           $ob = new Articles($value['nom'], $value['tarif'], $Taxe20, $catEnfant);
           $ob->setDesignation($value['nom']);
           array_push($topersist, $ob );
       }
       
       foreach ($listeArticleFemme as  $value) {
           $ob = new Articles($value['nom'],$value['tarif'], $Taxe20, $catFemme);
           $ob->setDesignation($value['nom']);
           array_push($topersist, $ob );
       }
       foreach ($listeArticleHomme as  $value) {
           $ob = new Articles($value['nom'],$value['tarif'], $Taxe20, $catHomme);
           $ob->setDesignation($value['nom']);
           array_push($topersist, $ob );
       }
       
       
       
        // create articles  $nom, $prixHt, $taxe, $categorie
       $art1 = new Articles("coupe homme classic", 19,$Taxe20, $catHomme );
       $art1->setDesignation("shampoing + coupe pour Homme");
       
       
       
       $art2 = new Articles("coupe femme classic", 24, $Taxe20, $catHomme);
       $art2->setDesignation("shampoing + coupe pour Femme");
        
        $art3 = new Articles("coupe enfant classic", 12, $Taxe20, $catHomme);
        $art3->setDesignation("shampoing + coupe pour Enfant");
        
        $art4 = new Articles("shampoing femme", 14, $Taxe20, $catFemme);
        $art4->setDesignation("shampoing pour Femme");
        
        $art5 = new Articles("diver", null, $Taxe20, $catProd);
        $art5->setDesignation("divers-test");
        $art5->setEditable(true);
        
        $art6 = new Articles("Couleur", 38, $Taxe20, $catFemme);
        $art6->setDesignation("Couleur test");
        $art6->setTechnique(true);
        
        
        
        
        array_push($topersist,$art1, $art2, $art3, $art4, $art5, $art6);
         $this->addReference($art1->getNom(), $art1);
         $this->addReference($art2->getNom(), $art2);
         $this->addReference($art3->getNom(), $art3);
         $this->addReference($art4->getNom(), $art4);
         $this->addReference($art5->getNom(), $art5);
         $this->addReference($art6->getNom(), $art6);
        
        
        
         foreach ($topersist as $value) {
            $manager->persist($value);
           
        }
        $manager->flush();
    }

    
    public function getOrder() {
        return 2;
    }

}
