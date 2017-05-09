<?php

namespace ApplicationBundle\Controller;

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
       return  $this->render('ApplicationBundle:Temoignage:index.html.twig',
                array(
                    
                            'temoignages'=>$temoignages,
                
                ));
    }
	
	
 public function benevoleAction()
    {
        $temoignages = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Temoignage')
                                     ->findListeTemoignageBenevole();
       return  $this->render('ApplicationBundle:Temoignage:benevole.html.twig',
                array(
                    
                            'temoignages'=>$temoignages,
                
                ));
    }
	
	 public function membreAction()
    {
        $temoignages = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Temoignage')
                                     ->findListeTemoignageMembre();
       return  $this->render('ApplicationBundle:Temoignage:membre.html.twig',
                array(
                    
                            'temoignages'=>$temoignages,
                
                ));
    }
	
	 public function partenaireAction()
    {
        $temoignages = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Temoignage')
                                     ->findListeTemoignagePartenaire();
       return  $this->render('ApplicationBundle:Temoignage:partenaire.html.twig',
                array(
                    
                            'temoignages'=>$temoignages,
                
                ));
    }
	
	
}
