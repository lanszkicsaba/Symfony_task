<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HelloWorld
{
    /**
     * @Route("/helloworld")
     */
    public function sayHelloworld()
    {
        return new Response('Hello.Word!');
    }
}