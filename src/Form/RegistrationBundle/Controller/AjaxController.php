<?php

namespace Form\RegistrationBundle\Controller;

use Form\RegistrationBundle\Validator\Constraints\CheckPassword;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AjaxController
 * @package Form\RegistrationBundle\Controller
 */
class AjaxController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function validatePasswordAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $data = '';
            $translator = $this->get('translator');

            $password = json_decode($request->request->get('password'));
            $passwordConstraint = new CheckPassword();
            $error = $this->get('validator')->validateValue($password, $passwordConstraint);
            if (count($error) == 1) {
                $data = array('success' => false, 'error' => $translator->trans($error[0]->getMessageTemplate()),'code' => $error[0]->getCode());
            }

            return new JsonResponse($data);

        }
        return new JsonResponse('json response', 500);
    }
}
