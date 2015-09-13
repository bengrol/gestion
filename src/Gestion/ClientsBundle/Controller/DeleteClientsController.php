<?php

namespace Gestion\ClientsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeleteClientsController extends Controller
{
    public function indexAction($idClient)
    {
        $em = $this->getDoctrine()->getManager();
        //$client = new \Gestion\ClientsBundle\Entity\Clients();
        $client = $em->getRepository("GestionClientsBundle:Clients")->find($idClient);
        
        $em->remove($client);
        $em->flush();
        
         $flash = $this->get('session');
                $flash->getFlashBag()->add(
                            'notice',
                            'Le client '.$client->getNom().' '.$client->getPrenom(). ' a bien été supprimé'
                            );
        
//        return $this->redirect('GestionClientsBundle:Clients:delete.html.twig',
//                array('idClient' => $idClient));
        
        
        
        return $this->redirect($this->generateUrl('gestion_clients_get'));
        
    }
}
