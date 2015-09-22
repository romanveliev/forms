<?php

namespace Form\RegistrationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxControllerTest extends WebTestCase
{
    public function testValidatepassword()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajax');
    }

}
