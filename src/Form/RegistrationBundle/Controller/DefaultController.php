<?php

namespace Form\RegistrationBundle\Controller;

use Form\RegistrationBundle\Entity\Roles;
use Form\RegistrationBundle\Entity\Users;
use Form\RegistrationBundle\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class DefaultController
 * @package Form\RegistrationBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function indexAction(Request $request)
    {
        $user = new Users();
        $form = $this->createForm(new UsersType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $role = new Roles();
            $role->setRole('ROLE_ADMIN');

            $data = $request->request->all();
            $options = ['cost' => 12];
            $hashPassword = password_hash($data['form_registrationbundle_users']['password']['first'], PASSWORD_BCRYPT, $options);

            $user->setName($data['form_registrationbundle_users']['name']);
            $user->setEmail($data['form_registrationbundle_users']['email']);
            $user->setPassword($hashPassword);

            $user->setRole($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
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

        $form = $this->createFormBuilder()
            ->add('email','text', ['label' => 'Email', 'attr'=>['class' => 'form-control'],
                    'constraints' => [new NotBlank(),new Length(['min'=>5,'max'=>15]), new Email()]
               ])
            ->add('password', 'password',['attr'=>['class' => 'form-control'],
                'constraints' => [new NotBlank(),new Length(['min'=>5,'max'=>15])]
            ])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $request->request->all();
            $email = $data['form']['email'];
            $password = $data['form']['password'];

            $user = $this->getDoctrine()
                ->getRepository('FormRegistrationBundle:Users')
                ->findOneBy(['email' => $email]);
            $hashPassword = $user->getPassword();

            if($user && password_verify($password, $hashPassword)){

                return $this->redirect($this->generateUrl('auth_success'));
            }else{
                $request->getSession()
                    ->getFlashBag()
                    ->add('login_error', 'Check the fields!!!')
                ;
                return $this->render('FormRegistrationBundle:Default:Login.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('FormRegistrationBundle:Default:Login.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @return Response
     */
    public function registrationAction(){
        return new Response('thanks');
    }

    /**
     * @return Response
     */
    public function authSuccessAction(){
        return new Response('thanks auth');
    }
}
