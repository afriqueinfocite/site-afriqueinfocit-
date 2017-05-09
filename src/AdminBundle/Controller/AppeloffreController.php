<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Appeloffre;
use AdminBundle\Form\AppeloffreType;
use Symfony\Component\HttpFoundation\Request;

class AppeloffreController extends Controller  
{
  public function indexAction()
    {
       $appeloffres = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Appeloffre')
                                     ->findAllAppelOffre();
       return  $this->render('AdminBundle:Appeloffre:index.html.twig',
                array(
                    
                            'appeloffres'=>$appeloffres,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$appeloffre = new Appeloffre();
		$form = $this->createForm(AppeloffreType::class,$appeloffre );
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $appeloffre->getFichierjoint();
            $fileName = $this->get('service.fichier_appel_offre_uploader')->upload($file);
            $appeloffre->setFichierjoint($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($appeloffre);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'L\'appel d\'offre a été  bien enregistrée.'); 
			return $this->redirectToRoute('liste_appel_offre');
		}
		return $this->render('AdminBundle:Appeloffre:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, Appeloffre $appeloffres)
    {
         $form = $this-> createForm(AppeloffreType::class,$appeloffres);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			$file = $appeloffres->getFichierjoint();
            $fileName = $this->get('service.fichier_appel_offre_uploader')->upload($file);
            $appeloffres->setFichierjoint($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($appeloffres);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'appel d\'offre a été modifié avec succès');
			 return $this->redirectToRoute('liste_appel_offre');
		}
     
        return $this->render('AdminBundle:Appeloffre:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Appeloffre $appeloffres)
    {
         $form = $this->get('form.factory')->create(AppeloffreType::class,$appeloffres);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($appeloffres);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'appel d\'offre a été supprimé avec succès');
             return $this->redirectToRoute('liste_appel_offre');
         }
        return $this->render('AdminBundle:Appeloffre:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'appeloffre'=>$appeloffres,
        ));

    }
     
}
