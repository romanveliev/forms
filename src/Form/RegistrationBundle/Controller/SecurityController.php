<?php
namespace Form\RegistrationBundle\Controller;
// ...
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
    }


    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}