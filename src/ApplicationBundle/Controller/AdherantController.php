<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Adherant;
use AdminBundle\Form\AdherantType;
use Symfony\Component\HttpFoundation\Request;

class AdherantController extends Controller
{
    public function ajoutAction(Request $request)
    {
		$adherant = new Adherant();
		$form = $this->createForm(AdherantType::class,$adherant);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($adherant);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Votre démande d\'adhésion a été envoyé avec succès.'); 
		}
		return $this->render('ApplicationBundle:Adherant:index.html.twig',
					array( 
							'form' => $form->createView(),
						));
    }
	
	

	
}
