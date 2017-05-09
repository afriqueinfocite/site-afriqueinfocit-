<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Temoignage;
use AdminBundle\Form\TemoignageType;
use Symfony\Component\HttpFoundation\Request;

class TemoignageController extends Controller
{
  public function indexAction()
    {
       $temoignages = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Temoignage')
                                     ->findAllTemoignage();
       return  $this->render('AdminBundle:Temoignage:index.html.twig',
                array(
                    
                            'temoignages'=>$temoignages,
                
                ));
    }
  public function ajouterAction(Request $request)
    {
		$temoignage = new Temoignage();
		$form = $this->createForm(TemoignageType::class,$temoignage );
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $temoignage->getPhoto();
            $fileName = $this->get('service.photo_uploader')->upload($file);
            $temoignage->setPhoto($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($temoignage);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Le témoignage a été  bien enregistré.'); 
			return $this->redirectToRoute('liste_temoignage');
		}
		return $this->render('AdminBundle:Temoignage:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
  public function  modifierAction(Request $request, Temoignage $temoignage)
    {
         $form = $this-> createForm(TemoignageType::class,$temoignage);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			$file = $temoignage->getPhoto();
            $fileName = $this->get('service.photo_uploader')->upload($file);
            $temoignage->setPhoto($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($temoignage);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','Le témoignage a été modifié avec succès');
			 return $this->redirectToRoute('liste_temoignage');
		}
     
        return $this->render('AdminBundle:Temoignage:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Temoignage $temoignage)
    {
         $form = $this->get('form.factory')->create(TemoignageType::class,$temoignage);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($temoignage);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','Le témoignage a été supprimé avec succès');
             return $this->redirectToRoute('liste_temoignage');
         }
        return $this->render('AdminBundle:Temoignage:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'temoignage'=>$temoignage,
        ));

    }
    
}
