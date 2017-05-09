<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Contact;
use AdminBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {
		$contact = new Contact();
		$form = $this->createForm(ContactType::class,$contact);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$data = $form->getData();
			$message = 'Nom: '.$data->getNom().'<br/>'
						.'Prenom: '.$data->getPrenom().'<br/><br/>'
						.$data->getMessage();
			
			$message_envoyer = \Swift_Message::newInstance()
							 ->setSubject($data->getObjet())
							 ->setFrom($data->getEmail())
							 ->setTo('kramo4539@gmail.com')
							 ->setCharset('utf-8')
							 ->setContentType('text/html')
							 ->setBody($message);
			$this->get('mailer')->send($message_envoyer);
			
			$request->getSession()->getFlashBag()->add('notice', 'Votre message a été envoyé avec succès.'); 
		}
		return $this->render('ApplicationBundle:Contact:index.html.twig',
					array( 
							'form' => $form->createView(),
						));
    }
	
	

	
}
