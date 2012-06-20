<?php

namespace Coregen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('CoregenAdminBundle:Default:index.html.twig');
    }
}
