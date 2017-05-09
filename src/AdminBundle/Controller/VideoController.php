<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Video;
use AdminBundle\Form\VideoType;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends Controller
{
  public function indexAction()
    {
       $videos = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Video')
                                     ->findAllVideo();
       return  $this->render('AdminBundle:Video:index.html.twig',
                array(
                    
                            'videos'=>$videos,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$video = new Video();
		$form = $this->createForm(VideoType::class,$video);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($video); 
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'La vidéo a été  bien enregistrée.'); 
			return $this->redirectToRoute('liste_video');
		}
		return $this->render('AdminBundle:Video:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, Video $video)
    {
         $form = $this-> createForm(VideoType::class,$video);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->persist($video);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','La vidéo a été modifié avec succès');
			 return $this->redirectToRoute('liste_video');
		}
     
        return $this->render('AdminBundle:Video:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Video $video)
    {
         $form = $this->get('form.factory')->create(VideoType::class,$video);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($video);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','La vidéo a été supprimé avec succès');
             return $this->redirectToRoute('liste_video');
         }
        return $this->render('AdminBundle:Video:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'video'=>$video,
        ));

    }
    
}
