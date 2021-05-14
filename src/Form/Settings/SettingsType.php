<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class SettingsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cmsPageId', IntegerType::class, [
                'label' => 'CMS page id',
                'help' => 'Id of CMS page where map is to be inserted (e.g. 12).',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'constraints' => [new NotBlank()],
            ])
            ->add('mapHeight', IntegerType::class, [
                'label' => 'Map height',
                'help' => 'Map height in pixels (recommended: 470, max: 1000).',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'constraints' => [
                    new LessThanOrEqual(['value' => 1000]),
                    new NotBlank(),
                ],
            ]);
    }
}
