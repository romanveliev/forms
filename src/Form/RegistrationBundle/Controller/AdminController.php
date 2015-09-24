<?php

namespace Form\RegistrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class AdminController
 * @package Form\RegistrationBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @return Response
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function mainAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('FormRegistrationBundle:Admin:main.html.twig', array(
            // ...
        ));
    }

    /**
     * @return Response
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function showUsersAction(){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $users = $this->getDoctrine()
              ->getRepository('FormRegistrationBundle:Users')
              ->findAll();
        return $this->render('FormRegistrationBundle:Admin:users.html.twig', array(
            'users' => $users,
        ));
    }
}
