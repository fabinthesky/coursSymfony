<?php

namespace Ens\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DefaultController extends Controller {
	/**
	 *
	 * @param unknown $name        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction($name) {
		return $this->render ( 'EnsJobeetBundle:Default:index.html.twig', array (
				'name' => $name 
		) );
	}
	
	/**
	*@ApiDoc(
	*	resource=true,
	*	description="displays connexion form"
	*)
	*
	*/
	public function loginAction() {
		$request = $this->getRequest ();
		$session = $request->getSession ();
		
		// get the login error if there is one
		if ($request->attributes->has ( SecurityContext::AUTHENTICATION_ERROR )) {
			$error = $request->attributes->get ( SecurityContext::AUTHENTICATION_ERROR );
		} else {
			$error = $session->get ( SecurityContext::AUTHENTICATION_ERROR );
			$session->remove ( SecurityContext::AUTHENTICATION_ERROR );
		}
		
		return $this->render ( 'EnsJobeetBundle:Default:login.html.twig', array (
				// last username entered by the user
				'last_username' => $session->get ( SecurityContext::LAST_USERNAME ),
				'error' => $error 
		) );
	}
}
