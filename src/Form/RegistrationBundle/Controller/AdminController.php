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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function mainAction()
    {
        $session = new Session();
        if($session->get('ROLE') =='ROLE_ADMIN'){
            return $this->render('FormRegistrationBundle:Admin:main.html.twig', array(
                // ...
            ));
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showUsersAction(){
        $session = new Session();
        if($session->get('ROLE') =='ROLE_ADMIN'){
            $users = $this->getDoctrine()
                  ->getRepository('FormRegistrationBundle:Users')
                  ->findAll();

//            foreach($users as $user){
//                $role = $user->getRoles()->getName();
//                $user->setRoles($role);
//                dump($user);
//            }
//die();
            return $this->render('FormRegistrationBundle:Admin:users.html.twig', array(
                'users' => $users,
            ));

        }else{
            return $this->redirectToRoute('login');
        }
    }
}
