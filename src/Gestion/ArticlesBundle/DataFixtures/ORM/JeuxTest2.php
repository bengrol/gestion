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
       $catEnfant = $this->getReference("Enfant et Ado");
       $catProd = $this->getReference("Produit");
       
       
       
       
       $listeArticleHomme = array(

array('nom' => 'forf sh,cp,coif' , 'tarif' =>13.33 , 'designation'=>'shampoing, coupe, coiffage ' ),
array('nom' => 'forf cp,coif' , 'tarif' =>10.83 , 'designation'=>'coupe, coiffage ' ),
array('nom' => 'forf sh,cr,coif' , 'tarif' =>10.83 , 'designation'=>'shampoing, couronne, coiffage ' ),
array('nom' => 'forf Sh,cp,coif,ras trad' , 'tarif' =>25.00 , 'designation'=>'shampoing, coupe, coiffage, rasage traditionel' ),
array('nom' => 'forf Sh,cp,coif,taille au ras' , 'tarif' =>25.00 , 'designation'=>'shampoing, coupe, coiffage, taille au rasoir' ),
array('nom' => 'forf Sh,cp,coif,ras design' , 'tarif' =>29.17 , 'designation'=>'shampoing, coupe, coiffage, rasage design' ),

array('nom' => 'cp, cr' , 'tarif' =>7.50 , 'designation'=>'coupe, couronne' ),
array('nom' => 'perm Hom' , 'tarif' =>15.83 , 'designation'=>'permanente pour homme' ),
array('nom' => 'couleur homme' , 'tarif' =>17.50 , 'designation'=>'couleur pour homme' ),

array('nom' => 'Ras trad' , 'tarif' =>13.33 , 'designation'=>'Rasage trad à l\'ancienne (cp choux)' ),
array('nom' => 'Ras des' , 'tarif' =>17.50 , 'designation'=>'Rasage design' ),
array('nom' => 'entret barbe' , 'tarif' =>10.83 , 'designation'=>'entretien tracer de barbe (-12 jours)' ),
array('nom' => 'taille br ras' , 'tarif' =>12.50 , 'designation'=>'taille barbe au rasoir' ),
array('nom' => 'taille br cis' , 'tarif' =>5.83 , 'designation'=>'taille barbe aux ciseaux' ),
array('nom' => 'taille br tond' , 'tarif' =>4.17 , 'designation'=>'taille barbe tondeuse' ),
array('nom' => 'taille moust' , 'tarif' =>2.50 , 'designation'=>'taille moustache' )          
        );
       
       
       
       $listeArticleFemme = array(

array('nom' => 'forf sh,cp,brush ou m.e.p' , 'tarif' =>19.17 , 'designation'=>'shampoing, coupe, brushing ou mise en plis' ),
array('nom' => 'forf sh,brush ou m.e.p' , 'tarif' =>12.50 , 'designation'=>'shampoing, brushing ou mise en plis' ),

array('nom' => 'supp longueur' , 'tarif' =>4.17 , 'designation'=>'supplement longueur' ),
array('nom' => 'soin' , 'tarif' =>4.17 , 'designation'=>'soin' ),
array('nom' => 'mousse' , 'tarif' =>4.17 , 'designation'=>'mousse' ),
array('nom' => 'couleur à partir de' , 'tarif' =>19.17 , 'designation'=>'couleur' ),
array('nom' => 'permanente Fem' , 'tarif' =>20.00 , 'designation'=>'permanente Femme à partie de' ),
array('nom' => 'meches' , 'tarif' =>21.67 , 'designation'=>'mèches à partir de' ),
array('nom' => 'flash' , 'tarif' =>12.50 , 'designation'=>'flash' ),
array('nom' => 'decoloration' , 'tarif' =>20.83 , 'designation'=>'décoloration à partir de' ),
array('nom' => 'decapage' , 'tarif' =>16.67 , 'designation'=>'décapage à partir de' ),
array('nom' => 'chignon banane' , 'tarif' =>23.33 , 'designation'=>'chignon banane' ),
array('nom' => 'chignon +' , 'tarif' =>27.50 , 'designation'=>'chignon travaillé' ),
array('nom' => 'chignon ++' , 'tarif' =>31.67 , 'designation'=>'chignon travaillé ++' ),
array('nom' => 'forf mariage 2es' , 'tarif' =>78.33 , 'designation'=>'forfait mariage ( 2 essais + le jour j )' ),
array('nom' => 'forf mariage 1es' , 'tarif' =>58.33 , 'designation'=>'forfait mariage ( 1 essai + le jour j )' ),
array('nom' => 'tresse' , 'tarif' =>14.17 , 'designation'=>'tresse à partir de ' )   
        );
       
       
       $listeArticleEnfant = array(

array('nom' => 'sh,cp,coif -14' , 'tarif' =>11.67 , 'designation'=>'shampoing, coupe, coiffage -14 ans' ),
array('nom' => 'sh,cp,coif fille -18' , 'tarif' =>15.00 , 'designation'=>'shampoing, coupe, coiffage fille -18ans' ),

array('nom' => 'cp bb' , 'tarif' =>7.50 , 'designation'=>'coupe pour bébé' ),
array('nom' => 'cp enfant' , 'tarif' =>10.00 , 'designation'=>'coupe pour enfant' )


       );
       
       
       
       foreach ($listeArticleEnfant as  $value) {
           $ob = new Articles($value['nom'], $value['tarif'], $Taxe20, $catEnfant);
           $ob->setDesignation($value['designation']);
           array_push($topersist, $ob );
       }
       
       foreach ($listeArticleFemme as  $value) {
           $ob = new Articles($value['nom'],$value['tarif'], $Taxe20, $catFemme);
           $ob->setDesignation($value['designation']);
           array_push($topersist, $ob );
       }
       foreach ($listeArticleHomme as  $value) {
           $ob = new Articles($value['nom'],$value['tarif'], $Taxe20, $catHomme);
           $ob->setDesignation($value['designation']);
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
