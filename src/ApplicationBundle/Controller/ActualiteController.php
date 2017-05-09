<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Article;
use AdminBundle\Form\ArticleType;
use AdminBundle\Entity\Video;
use AdminBundle\Form\VideoType;
use Symfony\Component\HttpFoundation\Request;

class ActualiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationBundle:Actualite:index.html.twig');
    }
	
	public function articleAction()
	{
		$repository = $this->getDoctrine()->getManager()
		->getRepository('AdminBundle:Article');
		$listeArticles = $repository->findAllArticle();
		return $this->render('ApplicationBundle:Actualite:article.html.twig'
							 ,array(
								'listeArticles'=>$listeArticles,
							 ));
	}
	
	public function videoAction()
	{
			$repository = $this->getDoctrine()->getManager()
		->getRepository('AdminBundle:Video');
		$listeVideos = $repository->findAllVideo();
		return $this->render('ApplicationBundle:Actualite:videos.html.twig'
							 ,array(
								'listeVideos'=>$listeVideos,
							 ));
	}
	
	public function assembleAction()
	{
		$repository = $this->getDoctrine()->getManager()
							->getRepository('AdminBundle:AssembleGenerale');
		$listeassembles = $repository->findAllAssemble();
		
		return $this->render('ApplicationBundle:Actualite:assemble.html.twig',
								array('assembles'=>$listeassembles,
							));
	}
	
	public function reunionAction()
	{
		$repository = $this->getDoctrine()->getManager()
							->getRepository('AdminBundle:Reunion');
		$listereunions = $repository->findAllReunion();
		return $this->render('ApplicationBundle:Actualite:reunion.html.twig',
								array('reunions'=>$listereunions,
							));
	}
	
	  public function  detail_articleAction(Request $request, Article $article)
    {
     
        return $this->render('ApplicationBundle:Actualite:article-detail.html.twig',
                array(
                    'article'=>$article,
                ));
    }
	
	  public function  lecture_videoAction(Request $request, Video $video)
    {
     
        return $this->render('ApplicationBundle:Actualite:lecture-video.html.twig',
                array(
                    'video'=>$video,
                ));
    }
}
