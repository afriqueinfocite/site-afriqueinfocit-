<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Reunion;
use AdminBundle\Form\ReunionType;
use Symfony\Component\HttpFoundation\Request;

class ReunionController extends Controller
{
  public function indexAction()
    {
       $reunions = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Reunion')
                                     ->findAllReunion();
       return  $this->render('AdminBundle:Reunion:index.html.twig',
                array(
                    
                            'reunions'=>$reunions,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$reunion = new Reunion();
		$form = $this->createForm(ReunionType::class,$reunion );
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $reunion->getPiecejoint();
            $fileName = $this->get('service.fichier_reunion_uploader')->upload($file);
            $reunion->setPiecejoint($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($reunion);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'La réunion a été  bien enregistrée.'); 
			return $this->redirectToRoute('liste_reunion');
		}
		return $this->render('AdminBundle:Reunion:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, Reunion $reunion)
    {
         $form = $this-> createForm(ReunionType::class,$reunion);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			$file = $reunion->getPiecejoint();
            $fileName = $this->get('service.fichier_reunion_uploader')->upload($file);
            $reunion->setPiecejoint($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($reunion);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','La réunion a été modifié avec succès');
			 return $this->redirectToRoute('liste_reunion');
		}
     
        return $this->render('AdminBundle:Reunion:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Reunion $reunion)
    {
         $form = $this->get('form.factory')->create(ReunionType::class,$reunion);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($reunion);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','La réunion a été supprimé avec succès');
             return $this->redirectToRoute('liste_reunion');
         }
        return $this->render('AdminBundle:Reunion:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'reunion'=>$reunion,
        ));

    }
    
}
