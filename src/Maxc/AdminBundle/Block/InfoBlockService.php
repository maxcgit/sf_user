<?php
namespace Maxc\AdminBundle\Block;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class InfoBlockService extends BaseBlockService
{
    private $em;

    public function __construct($name, EngineInterface $templating, Registry $doctrine)
    {
        $this->em = $doctrine->getManager();
        parent::__construct($name, $templating);
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderPrivateResponse($blockContext->getTemplate(), array(
            'block'   => $blockContext->getBlock(),
            'context' => $blockContext,
            'data' => array(
                'users' => $this->em->getRepository('MaxcUserBundle:User')->getForInfoAdmin(),
                'usersact' => $this->em->getRepository('MaxcUserBundle:User')->getActive4InfoAdmin(),
            ),
        ));
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'MaxcAdminBundle:Block:info.html.twig',
        ));
    }

    public function getName()
    {
        return 'Info';
    }
}