<?php

namespace Auth\RegistrationBundle\Controller;

use Auth\RegistrationBundle\Entity\Registration;
use Auth\RegistrationBundle\Entity\Users;
use Auth\RegistrationBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $enquiry = new Users();
        $form = $this->createForm(new UsersType(), $enquiry);

        $form->handleRequest($request);
        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $session = new Session();
                $session->set('Authentication', 1);
                $session->getFlashBag()->add('success', 'You are authenticated !');

                $data = $request->request->all();

                $user = new Users();
                $user->setName($data['auth_registrationbundle_users']['name']);
                $user->setPassword($data['auth_registrationbundle_users']['password']);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirect($this->generateUrl('users_list'));
            }
        }
        return $this->render('AuthRegistrationBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showUsersAction(){
        $repository = $this->getDoctrine()
            ->getRepository('AuthRegistrationBundle:Users');

        $users = $repository->findAll();

        return $this->render('AuthRegistrationBundle:pages:usersList.html.twig', [
                    'users' => $users,
              ]
        );

    }

    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
