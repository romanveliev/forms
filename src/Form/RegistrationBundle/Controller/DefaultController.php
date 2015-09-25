<?php

namespace Form\RegistrationBundle\Controller;

use Form\RegistrationBundle\Entity\Roles;
use Form\RegistrationBundle\Entity\Users;
use Form\RegistrationBundle\Form\MyType;
use Form\RegistrationBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

/**
 * Class DefaultController
 * @package Form\RegistrationBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     */
    public function indexAction(Request $request)
    {

        $user = new Users();
        $form = $this->createForm(new UsersType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $request->request->all();
//            $role = new Roles();
//            $role->setName($data['form_registrationbundle_users']['roles']['name']);

            $data = $request->request->all();
            $options = ['cost' => 12];
            $hashPassword = password_hash($data['form_registrationbundle_users']['password']['first'], PASSWORD_BCRYPT, $options);

            $user->setName($data['form_registrationbundle_users']['name']);
            $user->setEmail($data['form_registrationbundle_users']['email']);
            $user->setPassword($hashPassword);

//            $user->setRoles($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
//            $em->persist($role);
            $em->flush();
            return $this->redirect($this->generateUrl('registration_success'));
        }

        return $this->render('FormRegistrationBundle:Default:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function loginAction(Request $request){

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('FormRegistrationBundle:Default:Login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);

    }

    public function loginCheckAction(){

    }

    /**
     * @return Response
     */
    public function registrationAction(){
        return $this->render('FormRegistrationBundle:Default:RegistrationSuccess.html.twig');
    }

    /**
     * @return Response
     */
    public function authSuccessAction(){
        return $this->render('FormRegistrationBundle:Default:AuthSuccess.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function cascadeValidationAction(Request $request){

        $user = new Users();
        $form = $this->createForm(new UsersType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {


            $role = new Roles();
            $role->setName('ROLE_USER');

            $data = $request->request->all();
            $options = ['cost' => 12];
            $hashPassword = password_hash($data['form_registrationbundle_users']['password']['first'], PASSWORD_BCRYPT, $options);

            $user->setName($data['form_registrationbundle_users']['name']);
            $user->setEmail($data['form_registrationbundle_users']['email']);
            $user->setPassword($hashPassword);

            $user->setRoles($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($role);
            $em->flush();
            return $this->redirect($this->generateUrl('registration_success'));
        }

        return $this->render('FormRegistrationBundle:Default:cascadeValidation.html.twig', array(
            'form' => $form->createView()));
    }
}
