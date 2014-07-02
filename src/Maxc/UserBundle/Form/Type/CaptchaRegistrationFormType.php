<?php
namespace Maxc\UserBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;

class CaptchaRegistrationFormType extends RegistrationFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('captcha', 'genemu_captcha', array(
            'mapped' => false
        ));
    }

    public function getName()
    {
        return 'maxc_captcha_registration';
    }
}