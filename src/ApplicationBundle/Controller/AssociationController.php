<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AssociationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationBundle:Association:index.html.twig');
    }
	
	public function historiqueAction()
	{
		return $this->render('ApplicationBundle:Association:historique.html.twig');
	}
	
	public function organigrammeAction()
	{
		return $this->render('ApplicationBundle:Association:organigramme.html.twig');
	}
	
	public function nos_solutionAction()
	{
		return $this->render('ApplicationBundle:Association:nos-solution.html.twig');
	}
	
	public function nos_projetAction()
	{
		return $this->render('ApplicationBundle:Association:nos-projet.html.twig');
	}
	
		public function implantationsAction()
	{
		return $this->render('ApplicationBundle:Association:implantations.html.twig');
	}
}
