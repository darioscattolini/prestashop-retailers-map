<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Marker;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;

class MarkerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Marker name',
                'help' => '(e.g. Brand stores)',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'attr' => ['maxlength' => '255'],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('iconDefault', FileType::class, [
                'label' => 'Default icon',
                'help' => 'Upload default size icon (use PNG with transparent background)',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => false,
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/png'],
                        'mimeTypesMessage' => 'Please upload a valid PNG image',
                    ])
                ]
            ])
            ->add('iconRetina', FileType::class, [
                'label' => 'Retina icon',
                'help' => 'Upload double size icon for HD displays (use PNG with transparent background)',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => false,
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/png'],
                        'mimeTypesMessage' => 'Please upload a valid PNG image',
                    ])
                ]
            ])
            ->add('iconWidth', IntegerType::class, [
                'label' => 'Icon width',
                'help' => 'Width of icon in map (pixels). ' . 
                    'Should not exceed width of uploaded default icon. ' . 
                    'Icon width and height should respect default icon\'s aspect ratio',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => true,
                'attr' => ['min' => '0'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual(['value' => 0]),
                ]
            ])
            ->add('iconHeight', IntegerType::class, [
                'label' => 'Icon height',
                'help' => 'Height of icon in map (pixels). ' . 
                    'Should not exceed height of uploaded default icon. ' . 
                    'Icon width and height should respect default icon\'s aspect ratio',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => true,
                'attr' => ['min' => '0'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual(['value' => 0]),
                ]
            ])
            ->add('anchorX', IntegerType::class, [
                'label' => 'Tip x-position',
                'help' => 'Position of icon tip in x axis (pixels). ' . 
                    '0 for left side, icon width for right side, or any value inbetween. ',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => true,
                'attr' => ['min' => '0'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual(['value' => 0]),
                ]
            ])
            ->add('anchorY', IntegerType::class, [
                'label' => 'Tip y-position',
                'help' => 'Position of icon tip in y axis (pixels). ' . 
                    '0 for top side, icon height for bottom side, or any value inbetween. ',
                'translation_domain' => 'Modules.Retailersmap.Marker',
                'required' => true,
                'attr' => ['min' => '0'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual(['value' => 0]),
                ]
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function($event) {
                $marker = $event->getData();
                
                /** @var Form */
                $form = $event->getForm();

                var_dump($marker);
                
                if (!$marker || !isset($marker['fileNameDefault'])) {
                    $form->add('iconDefault', FileType::class, [
                        'label' => 'Default icon',
                        'help' => 'Upload default size icon (use PNG with transparent background)',
                        'translation_domain' => 'Modules.Retailersmap.Marker',
                        'required' => true,
                        'constraints' => [
                            new Assert\File([
                                'maxSize' => '1024k',
                                'mimeTypes' => ['image/png'],
                                'mimeTypesMessage' => 'Please upload a valid PNG image',
                            ])
                        ]
                    ]);
                }
            });
    }
}

// custom validation could be added to keep anchors in range
// https://stackoverflow.com/questions/56269445/how-to-validate-field-that-depend-on-another-one-in-symfony
// https://stackoverflow.com/questions/20471812/conditional-field-validation-that-depends-on-another-field
