<?php

namespace Maxc\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
        return array();
    }

    /**
     * @Route("/tos", name="tos")
     * @Template()
     */
    public function tosAction()
    {
        return array();
    }

    /**
     * @Route("/privacy", name="privacy")
     * @Template()
     */
    public function privacyAction()
    {
        return array();
    }

    /**
     * @Route("/faq", name="faq")
     * @Template()
     */
    public function faqAction()
    {
        return array();
    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $defaultData = array('message' => '');
        $form = $this->createFormBuilder($defaultData)
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('subject', 'text')
            ->add('message', 'textarea')
            ->add('captcha', 'genemu_captcha', array('mapped' => false))
            ->add('send', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $message = \Swift_Message::newInstance()
                ->setSubject($this->container->getParameter('sitename').': '.$data['subject'])
                ->setFrom($data['email'])
                ->setTo($this->container->getParameter('mailer_user'))
                ->setBody(
                    $this->renderView(
                        'MaxcSiteBundle:Default:contact.txt.twig',
                        array('data' => $data, 'ip'=>$request->getClientIp())
                    )
                )
            ;
            $this->get('mailer')->send($message);
            return $this->render('MaxcSiteBundle:Default:contact_sent.html.twig', array());
        }

        return array('form'=>$form->createView());
    }

}
