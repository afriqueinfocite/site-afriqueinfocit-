<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Article;
use AdminBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
  public function indexAction()
    {
       $articles = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Article')
                                     ->findAllArticle();
       return  $this->render('AdminBundle:Article:index.html.twig',
                array(
                    
                            'articles'=>$articles,
                
                ));
    }
	  public function ajouterAction(Request $request)
    {
		$article = new Article();
		$article->setDate(new \Datetime());
		$form = $this->createForm(ArticleType::class,$article);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$file = $article->getPhoto();
            $fileName = $this->get('service.photo_uploader')->upload($file);
            $article->setPhoto($fileName);
			$em = $this->getDoctrine()->getManager();
			$em->persist($article); $em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'L\'article a été  bien enregistrée.'); 
			return $this->redirectToRoute('liste_article');
		}
		return $this->render('AdminBundle:Article:ajout.html.twig',array( 'form' => $form->createView(), ));
       
    }
	
	  public function  modifierAction(Request $request, Article $article)
    {
         $form = $this-> createForm(ArticleType::class,$article);
         $form->handleRequest($request);
       if($form->isSubmitted() && $request->isMethod('POST') && $form->isValid())
         {
			 $file = $article->getPhoto();
             $fileName = $this->get('service.photo_uploader')->upload($file);
             $article->setPhoto($fileName);
             $em = $this->getDoctrine()->getManager();
             $em->persist($article);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'article a été modifié avec succès');
			 return $this->redirectToRoute('liste_article');
		}
     
        return $this->render('AdminBundle:Article:modifier.html.twig',
                array(
                    'form'=> $form->createView(),
                ));
    }
    
	 
     public function supprimerAction(Request $request, Article $article)
    {
         $form = $this->get('form.factory')->create(ArticleType::class,$article);
         
         if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $em->remove($article);
             $em->flush();
             $request->getSession()->getFlashBag()->add('notice','L\'article a été supprimé avec succès');
             return $this->redirectToRoute('liste_article');
         }
        return $this->render('AdminBundle:Article:supprimer.html.twig',
        array(
                 'form' => $form->createView(),
                 'article'=>$article,
        ));

    }
    
}
