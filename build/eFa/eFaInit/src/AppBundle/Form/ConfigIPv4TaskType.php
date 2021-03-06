<?php
// src/AppBundle/Form/ConfigIPv4TaskType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConfigIPv4TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Yes', SubmitType::class)
            ->add('No', SubmitType::class)
            ->add('Back', SubmitType::class, array(
                'validation_groups' => false
            ))
        ;
    }
}
?>
