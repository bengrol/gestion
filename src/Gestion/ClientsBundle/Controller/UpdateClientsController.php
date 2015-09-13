<?php

namespace Gestion\ClientsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ClientsBundle\Form\ClientsType;

class UpdateClientsController extends Controller
{
    public function indexAction($idClient)
    {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository("GestionClientsBundle:Clients")->find($idClient);
        $form = $this->createForm(new ClientsType(), $client);
        
        
        
        /*
         * si le formulaire est validé
         */
        
        $request = $this->getRequest(); 
        
        
        if($request->isMethod("POST")){
            
            $form->bind($request);
        
            if($form->isValid()){
                
                
                $client = $form->getData();
                $em->persist($client);
                $em->flush();

                $flash = $this->get('session');
                $flash->getFlashBag()->add(
                            'notice',
                            'Le client '.$client->getNom().' '.$client->getPrenom(). ' a bien été mis à jour'
                            );

            }
        
        }
        /*
         * Sinon on affiche le form remplis avec les champs de la BDD
         */
        
        
        return $this->render('GestionClientsBundle:Clients:update.html.twig',
                    array(
                        'client' => $client,
                        'form' => $form->createView()
                    )
                );
    }
    
    
}
