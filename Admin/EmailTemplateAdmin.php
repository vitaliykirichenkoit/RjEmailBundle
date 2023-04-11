<?php

namespace Rj\EmailBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmailTemplateAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'email_template';
    protected $baseRoutePattern = 'email_template';
    protected $locales;

    public function setLocales(array $locales)
    {
        $this->locales = $locales;
    }

    //show
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    //add
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Email Templates')
            ->add('name')
            ->end()
        ;

        $locales = $this->locales;

        foreach ($locales as $locale) {
            $form
                ->with(sprintf("Subject", $locale))
                ->add(sprintf("translationProxies_%s_subject", $locale), TextType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].subject', $locale),
                ))
                ->end()
            ;
        }

        foreach ($locales as $locale) {
            $form
                ->with(sprintf("Preheader", $locale))
                ->add(sprintf("translationProxies_%s_preheader", $locale), TextType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].preheader', $locale),
                ))
                ->end()
            ;
        }

        foreach ($locales as $locale) {
            $form
                ->with(sprintf("Text body", $locale))
                ->add(sprintf("translationProxies_%s_body", $locale), TextareaType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].body', $locale),
                ))
                ->end()
                ->with(sprintf("Html body", $locale))
                ->add(sprintf("translationProxies_%s_body_html", $locale), TextType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].bodyHtml', $locale),
                ))
                ->end()
            ;
        }

        foreach ($locales as $locale) {
            $form
                ->with(sprintf("From name", $locale))
                ->add(sprintf("translationProxies_%s_fromName", $locale), TextType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].fromName', $locale),
                    'required' => false,
                ))
                ->end()
            ;
        }

        foreach ($locales as $locale) {
            $form
                ->with(sprintf("From email", $locale))
                ->add(sprintf("translationProxies_%s_fromEmail", $locale), EmailType::class, array(
                    'label' => $locale,
                    'property_path' => sprintf('translationProxies[%s].fromEmail', $locale),
                    'required' => false,
                ))
                ->end()
            ;
        }
    }

    //list
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('createdAt')
            ->addIdentifier('updatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if ('edit' == $action) {
            $item = $this->getMenuFactory()->createItem('send_test', array(
                'uri' => 'javascript:void(send_test())',
                'label' => 'Send test email',
            ));
            $menu->addChild($item);
        }
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->add('send_test', $this->getRouterIdParameter().'/send_test');
    }
}
