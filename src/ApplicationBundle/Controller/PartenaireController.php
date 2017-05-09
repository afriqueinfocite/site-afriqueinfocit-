<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartenaireController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationBundle:Partenaire:index.html.twig');
    }
	
	public function administrationAction()
	{
		$repository = $this->getDoctrine()
							->getManager()
							->getRepository('AdminBundle:Partenaire');
		$listePartenairesAdministrations = $repository->findListePartenaireAdministrations();
		
		return $this->render('ApplicationBundle:Partenaire:administration.html.twig',
								array(
								
									'listePartenairesAdministrations'=>$listePartenairesAdministrations,
								));
							
	}
	
	public function EntrepriseAction()
	{
		$repository = $this->getDoctrine()
							->getManager()
							->getRepository('AdminBundle:Partenaire');
		$listePartenairesEntrprises = $repository->findListePartenaireEntreprise();
		
		return $this->render('ApplicationBundle:Partenaire:entreprise.html.twig',
								array(
								
									'listePartenairesEntrprises'=>$listePartenairesEntrprises,
								));
							
	}
	
	
	public function AssociationAction()
	{
		$repository = $this->getDoctrine()
							->getManager()
							->getRepository('AdminBundle:Partenaire');
		$listePartenairesAssociations = $repository->findListePartenaireAssociation();
		
		return $this->render('ApplicationBundle:Partenaire:association.html.twig',
								array(
								
									'listePartenairesAssociations'=>$listePartenairesAssociations,
								));
							
	}
	
		public function AppeloffreAction()
	{
		$listeAppelsOffres = $this->getDoctrine()
                                     ->getManager()
                                     ->getRepository('AdminBundle:Appeloffre')
                                     ->findAllAppelOffre();
		
		return $this->render('ApplicationBundle:Partenaire:appel-offres.html.twig',
								array(
								
									'listeAppelsOffres'=>$listeAppelsOffres,
								));
							
	}
	
}
