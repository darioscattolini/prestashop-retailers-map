<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Group;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class GroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Group name',
                'help' => '(e.g. Highlighted stores)',
                'translation_domain' => 'Modules.Retailersmap.Group',
                'attr' => ['maxlength' => '255'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('groupMarker', TextType::class, [       //this will be separated
                'label' => 'Default group marker',
                'help' => 'Name of group marker icon file',
                'translation_domain' => 'Modules.Retailersmap.Group',
                'required' => false,
                'attr' => ['maxlength' => '255'],
            ])
            ->add('groupRetinaMarker', TextType::class, [       //this will be separated
                'label' => 'Retina group marker',
                'help' => 'Name of high resolution marker icon file',
                'translation_domain' => 'Modules.Retailersmap.Group',
                'required' => false,
                'attr' => ['maxlength' => '255'],
            ])
            ->add('stackOrder', IntegerType::class, [
                'label' => 'Stack order',
                'help' => 'Order in which group markers are stacked one above the other in case of marker overlapping (from botton to top)',
                'translation_domain' => 'Modules.Retailersmap.Group',
                'attr' => ['min' => '0'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual(['value' => 0]),
                ],
            ]);
    }
}
