<?php

namespace Form\RegistrationBundle\Controller;

use Form\RegistrationBundle\Entity\Feedback;
use Form\RegistrationBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class FeedbackController
 * @package Form\RegistrationBundle\Controller
 */
class FeedbackController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $comment = new Feedback();
        $form = $this->createForm(new FeedbackType(), $comment, ['action' => $this->generateUrl('index_feedback')]);

        if ($request->isXMLHttpRequest()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $request->request->all();
            }
        }
            return $this->render('FormRegistrationBundle:Feedback:index.html.twig', [
                'form' =>$form->createView(),
            ]);


    }

}
