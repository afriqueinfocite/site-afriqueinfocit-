<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\AssembleGenerale;
use AdminBundle\Form\AssembleGeneraleType;
use Symfony\Component\HttpFoundation\Request;

class AssembleController extends Controller
{
  public function indexAction()
    {
       $assembles = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:AssembleGenerale')
                                     ->findAllAssemble();
       return  $this->render('AdminBundle:Assemble:index.html.twig',
                array(
                    
                            'assembles'=>$assembles,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$assemble = new AssembleGenerale();
		$form = $this->createForm(AssembleGeneraleType::class,$assemble );
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $assemble->getPiecejoint();
            $fileName = $this->get('service.fichier_assemble_uploader')->upload($file);
            $assemble->setPiecejoint($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($assemble);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'L\'assemblee générale a été  bien enregistrée.'); 
			return $this->redirectToRoute('liste_assemble');
		}
		return $this->render('AdminBundle:Assemble:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, AssembleGenerale $assemble)
    {
         $form = $this-> createForm(AssembleGeneraleType::class,$assemble);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			$file = $assemble->getPiecejoint();
            $fileName = $this->get('service.fichier_reunion_uploader')->upload($file);
            $assemble->setPiecejoint($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($assemble);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'assemblée a été modifié avec succès');
			 return $this->redirectToRoute('liste_assemble');
		}
     
        return $this->render('AdminBundle:Assemble:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, AssembleGenerale $assemble)
    {
         $form = $this->get('form.factory')->create(AssembleGeneraleType::class,$assemble);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($assemble);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'assemblée a été supprimé avec succès');
             return $this->redirectToRoute('liste_assemble');
         }
        return $this->render('AdminBundle:Assemble:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'assemble'=>$assemble,
        ));

    }
    
}
