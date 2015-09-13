<?php

namespace Gestion\ClientsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ClientsBundle\Form\ClientsType;


class CreateClientsController extends Controller
{
    public function indexAction() {
        
        $form = $this->createForm(new ClientsType());
        
        $em = $this->getDoctrine()->getManager();
        $em->getRepository("GestionClientsBundle:Clients");
        
        
        /*
         * si le formulaire est validé
         */
        $request = $this->getRequest(); 
        if($request->isMethod("POST")){
           
            
            $form->bind($request);
         
            
            if($form->isValid()){
                
                 $nom = $form->get('nom')->getData();
                
                //$client = new \Gestion\ClientsBundle\Entity\Clients($nom);
                $client = $form->getData();
                
                
                $em->persist($client);
                $em->flush();
                
                //var_dump($client); die();
                
                $rep = $em->getRepository("GestionClientsBundle:Clients");
                
               $flash = $this->get('session');
                $flash->getFlashBag()->add(
                            'notice',
                            'Le client '.$client->getNom().' '.$client->getPrenom(). ' a bien été créé'
                            );
                
                return $this->render( 
                        'GestionClientsBundle:Clients:get.html.twig',
                            array( 
                                'idClient' => $client->getId(), 
                                'client' => $client, 
                                'listeCmd'=> null
                            )
                );
                    

            }
        }
        
        
        return $this->render( 'GestionClientsBundle:Clients:create.html.twig',
               array('form' => $form->createView() ));
    }
}
