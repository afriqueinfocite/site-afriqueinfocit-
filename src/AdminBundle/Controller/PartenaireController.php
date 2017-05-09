<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Partenaire;
use AdminBundle\Form\PartenaireType;
use Symfony\Component\HttpFoundation\Request;

class PartenaireController extends Controller
{
  public function indexAction()
    {
       $partenaires = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Partenaire')
                                     ->findAll();
       return  $this->render('AdminBundle:Partenaire:index.html.twig',
                array(
                    
                            'listePartenaires'=>$partenaires,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$partenaire = new Partenaire();
		$form = $this->createForm(PartenaireType::class,$partenaire);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $partenaire->getPhoto();
            $fileName = $this->get('service.photo_uploader')->upload($file);
            $partenaire->setPhoto($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($partenaire);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Le parténaire a été  bien enregistré.'); 
			return $this->redirectToRoute('liste_partenaire');
		}
		return $this->render('AdminBundle:Partenaire:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, Partenaire $partenaire)
    {
         $form = $this-> createForm(PartenaireType::class,$partenaire);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			 $file = $partenaire->getPhoto();
             $fileName = $this->get('service.photo_uploader')->upload($file);
             $partenaire->setPhoto($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($partenaire);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','Le partenaire a été modifié avec succès');
			 return $this->redirectToRoute('liste_partenaire');
		}
     
        return $this->render('AdminBundle:Partenaire:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Partenaire $partenaire)
    {
         $form = $this->get('form.factory')->create(PartenaireType::class,$partenaire);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($partenaire);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','Le partenaire a été supprimé avec succès');
             return $this->redirectToRoute('liste_partenaire');
         }
        return $this->render('AdminBundle:Partenaire:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'partenaire'=>$partenaire,
        ));

    }
    
}
