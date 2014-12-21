<?php

namespace Maxc\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('ip')
            ->add('username')
            ->add('email')
            ->add('enabled')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('enabled')
            ->add('ip')
            ->addIdentifier('username')
            ->add('email')
            ->add('createdAt')
            ->add('lastLogin')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
//                    'edit' => array(),
//                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username')
            ->add('email')
            ->add('enabled','choice',array('choices' =>  array(0=>'Off',1=>'On')))
            ->add('locked','choice',array('choices' =>  array(0=>'Off',1=>'On')))
            ->add('ip')
            ->add('ip_hist')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('roles')
            ->add('id')
            ->add('ip')
            ->add('ip_hist')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureRoutes(RouteCollection $collection)
    {
        $collection->add('stat', 'stat');
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $admin = $this;
        $menu->addChild(
            'List',
            array('uri' => $admin->generateUrl('list'))
        );
        $menu->addChild(
            'Stat',
            array('uri' => $admin->generateUrl('stat'))
        );

    }

}
