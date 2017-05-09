<?php

namespace ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\Emploi;
use AdminBundle\Form\EmploiType;
use Symfony\Component\HttpFoundation\Request;

class EmploiController extends Controller
{
    public function emploiAction(Request $request)
    {
		$emploi = new Emploi();
		$form = $this->createForm(EmploiType::class,$emploi);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{

			$path = 'http://localhost/afriqueinfocite/web/uploads/fichieremploi';
			//recuperation du nom du fichier cv
			$file_cv = $emploi->getCv();
            $fileName_cv = $this->get('service.fichiers_email_uploader')->upload($file_cv);
			
			
			//recuperation du nom du fichier lettre de motivation
			$file_lm = $emploi->getMotivation();
            $fileName_lm = $this->get('service.fichiers_email_uploader')->upload($file_lm);
			
			
			$data = $form->getData();
			$message = 'Nom: '.$data->getNom().'<br/>'
						.'Prenom: '.$data->getPrenom().'<br/><br/>'
						.'Téléphone: '.$data->getTelephone().'<br/>'
						.$data->getMessage();

			$message_envoyer = \Swift_Message::newInstance()
							 ->setSubject('Candidature spontannée')
							 ->setFrom($data->getEmail())
							 ->setTo('kramo4539@gmail.com')
							 ->setCharset('utf-8')
							 ->setContentType('text/html')
							 ->setBody($message)
							 ->attach(\Swift_Attachment::fromPath($path.'/'.$fileName_cv))
							 ->attach(\Swift_Attachment::fromPath($path.'/'.$fileName_lm));

			
			$this->get('mailer')->send($message_envoyer);
			
			$request->getSession()->getFlashBag()->add('notice', 'Votre message a été envoyé avec succès.'); 
		}
		return $this->render('ApplicationBundle:Emploi:index.html.twig',
					array( 
							'form' => $form->createView(),
						));
    }
	
	

	
}
