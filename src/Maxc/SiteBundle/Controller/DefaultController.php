<?php

namespace Maxc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
//        $request->getSession()->getFlashBag()->add('notice', 'Profile updated');
//        $request->getSession()->getFlashBag()->add('error', 'Profile updated');
        return array('name' => 'world');
    }
}
