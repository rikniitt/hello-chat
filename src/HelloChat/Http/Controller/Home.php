<?php

namespace HelloChat\Http\Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class Home extends Controller
{

    public function index(Request $request, Application $app)
    {
        return $app['twig']->render('home/index.twig');
    }

}
