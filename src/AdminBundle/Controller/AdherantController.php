<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Adherant;
use AdminBundle\Form\AdherantType;
use Symfony\Component\HttpFoundation\Request;

class AdherantController extends Controller
{
  public function indexAction()
    {
       $adherants= $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Adherant')
                                     ->findAllAdherant();
       return  $this->render('AdminBundle:Adherant:index.html.twig',
                array(
                    
                            'adherants'=>$adherants,
                
                ));
    }

     public function supprimerAction(Request $request, Adherant $adherant)
    {
         $form = $this->get('form.factory')->create(AdherantType::class,$adherant);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($adherant);
             $em->flush();
             return $this->redirectToRoute('liste_adherant');
         }
        return $this->render('AdminBundle:Adherant:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'adherant'=>$adherant,
        ));

    }
    
}
