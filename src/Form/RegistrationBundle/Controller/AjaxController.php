<?php

namespace Form\RegistrationBundle\Controller;

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
            $password = json_decode($request->request->get('password'));
            $length = strlen($password);
            if(!preg_match('/^[a-z0-9_-]{1,18}$/', $password)){
                return new JsonResponse([$password, 'message' => 0]);
            }
            /*
             * too small password
             */
            if( ($length >= 0) && ($length <= 5) ){
                return new JsonResponse([$password, 'message' => 1]);
            }
            /*
             * weak password
             */
            if( ($length >= 6) && ($length <= 8) ){
                return new JsonResponse([$password, 'message' => 2]);
            }
            /*
             * good password
             */
            if( ($length >= 9) && ($length <= 15) ){
                return new JsonResponse([$password, 'message' => 3]);
            }
            /*
             * too many symbols
             */
            if($length >=15 ){
                return new JsonResponse([$password, 'message' => 4]);
            }

        }
        return new JsonResponse('json response', 500);
    }
}
