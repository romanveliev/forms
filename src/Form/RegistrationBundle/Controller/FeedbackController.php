<?php

namespace Form\RegistrationBundle\Controller;

use Form\RegistrationBundle\Entity\Feedback;
use Form\RegistrationBundle\Form\FeedbackType;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


/**
 * Class FeedbackController
 * @package Form\RegistrationBundle\Controller
 */
class FeedbackController extends Controller
{
    private $captchaSecretKey;
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $comment = new Feedback();
        $form = $this->createForm(new FeedbackType(), $comment, ['action' => $this->generateUrl('index_feedback')]);

        if ($request->isXMLHttpRequest()) {
            $this->captchaSecretKey = $this->getParameter('captcha_private_key');
            $data = json_decode($request->request->get('feedback'));

            if(isset($data[3])){
                $recaptcha = new ReCaptcha($this->captchaSecretKey);
                $resp = $recaptcha->verify($data[3], $_SERVER['REMOTE_ADDR']);
                if($resp->isSuccess()){
                    $translator = $this->get('translator');
                    unset($data[count($data)-1]);

                    $mailConstraint = new Email();
                    $mailConstraint->message = 'invalid_email_address';

                    $regexConstraint = new Regex(['pattern' => '/^[a-zA-Z]{3,16}$/']);
                    $regexConstraint->message = 'invalid_name';

                    /**
                     * notBlank for name, email, comment
                     */
                    $this->checkNotBlack($data);

                    /**
                     * name validation
                     */
                    $errorName = $this->get('validator')->validate($data[0], $regexConstraint);
                    if(count($errorName) != 0){
                        $data = array('success' => false, 'error' => $translator->trans($errorName[0]->getMessage()),'code' => 0);
                        return new JsonResponse($data);
                    }

                    /**
                     * email validation. If it's ok, save in database.
                     */
                    $error = $this->get('validator')->validate($data[1], $mailConstraint);

                    if(count($error) != 0){
                        $data = array('success' => false, 'error' => $translator->trans($error[0]->getMessage()),'code' => 0);
                        return new JsonResponse($data);
                    }

                        $session = new Session();
                        $comment->setEmail($data[1]);
                        $comment->setName($data[0]);
                        $comment->setComment($data[2]);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($comment);
                        $em->flush();
                        $session->getFlashBag()->add('feedback', 'Thanks for feedback!!!!!!');

                        $data = array('success' => 'sucess', 'code' => 1);
                        return new JsonResponse($data);
                }//success captcha
            }
        }

        return $this->render('FormRegistrationBundle:Feedback:index.html.twig', [
            'form' =>$form->createView(),
        ]);
    }

    private function checkNotBlack($data){
        $translator = $this->get('translator');
        $notBlank = new NotBlank();
        $notBlank->message = 'all_fields_should_not_be_blank';
        foreach($data as $field){
            $errorNotBlank = $this->get('validator')->validate($field, $notBlank);
            if(count($errorNotBlank)!=0){
                $data = array('success' => false, 'error' => $translator->trans($errorNotBlank[0]->getMessage()),'code' => 0);
                return new JsonResponse($data);
            }
        }
    }

}
