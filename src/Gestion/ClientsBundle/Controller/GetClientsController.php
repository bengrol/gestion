<?php
namespace Gestion\ClientsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\ClientsBundle\Entity\Clients;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GetClientsController extends Controller
{
    
    
    public function indexAction($idClient)
    {
        $request = Request::createFromGlobals();
        $he = $request->headers;
        

        $em = $this->getDoctrine()->getManager();
        
        if($idClient == "all"){
            $req = 'SELECT c  '
                . 'FROM GestionClientsBundle:Clients c '
                . 'ORDER BY c.nom ASC ';
            $query = $em->createQuery($req );
            $clients = $query->getArrayResult();
            
            if($he->get('Content-Type')=='application/json') {
                $response = new Response();
                $response->setContent(json_encode($clients));
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            }

            return $this->render('GestionClientsBundle:Clients:getAll.html.twig',
                array( 'clients' => $clients));
        }
        
       $client =  $em->getRepository("GestionClientsBundle:Clients")->find($idClient);
       

       
       $listeCmd = $client->getListeCommande();
        
        return $this->render('GestionClientsBundle:Clients:get.html.twig',
                array( 
                    'client' => $client,
                    'listeCmd' =>$listeCmd , 
                    
                ));
    }
    
    
    public function homeAction()
    {
        return $this->render('GestionClientsBundle:Clients:home.html.twig');
    }

    
    
}




