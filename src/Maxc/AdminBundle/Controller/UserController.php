<?php

namespace Maxc\AdminBundle\Controller;
 
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function statAction(Request $request){

        $period = array('from'=>new \DateTime('first day of this month'),'to'=>new \DateTime('tomorrow'),'byhour'=>null);
        $form = $this->createFormBuilder($period)
            ->add('from', 'date')
            ->add('to', 'date')
            ->add('byhour', 'checkbox',array('required'=>false))
            ->add('ok', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $period = $form->getData();
        }

        return $this->render('MaxcAdminBundle:User:stat.html.twig', array(
            'action' => 'stat',
            'data' => $this->getDoctrine()->getManager()->getRepository('MaxcUserBundle:User')->getByDt($period['from'],$period['to'],$period['byhour']),
            'form' => $form->createView()
        ));
    }

}