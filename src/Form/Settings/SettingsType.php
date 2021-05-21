<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
                'constraints' => [
                    new Assert\NotBlank()
                ],
            ])
            ->add('height', IntegerType::class, [
                'label' => 'Map height',
                'help' => 'Map height in pixels (recommended: 470, max: 1000).',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'constraints' => [
                    new Assert\LessThanOrEqual(['value' => 1000]),
                    new Assert\NotBlank(),
                ],
            ])
            ->add('tilesProvider', ChoiceType::class, [
                'label' => 'Tiles provider',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'choices' => $this->getTilesProviderChoices(),
                'constraints' => [new Assert\NotBlank()],
            ]);
    }

    /**
     * @return array
     */
    private function getTilesProviderChoices(): array {
        return [
            'OpenStreetMap Mapnik' => 'OpenStreetMap.Mapnik',
            'OpenStreetMap Deutsch' => 'OpenStreetMap.DE',
            'OpenStreetMap CH' => 'OpenStreetMap.CH',
            'OpenStreetMap French' => 'OpenStreetMap.France',
            'OpenStreetMap HOT' => 'OpenStreetMap.HOT',
            'OpenStreetMap BZH' => 'OpenStreetMap.BZH',
            'Stadia Alidade Smooth' => 'Stadia.AlidadeSmooth',
            'Stadia Alidade Smooth Dark' => 'Stadia.AlidadeSmoothDark',
            'Stadia OSM Bright' => 'Stadia.OSMBright',
            'Stadia Outdoors' => 'Stadia.Outdoors',
            'CyclOSM' => 'CyclOSM',
            'Stamen Toner' => 'Stamen.Toner',
            'Stamen Toner Background' => 'Stamen.TonerBackground',
            'Stamen TonerLife' => 'Stamen.TonerLife',
            'Stamen Watercolor' => 'Stamen.Watercolor',
            'Esri World Street Map' => 'Esri.WorldStreetMap',
            'Esri DeLorme' => 'Esri.DeLorme',
            'Esri World TopoMap' => 'Esri.WorldTopoMap',
            'Esri World Imagery' => 'Esri.WorldImagery',
            'CartoDB Positron' => 'CartoDB.Positron',
            'CartoDB Voyager' => 'CartoDB.Voyager',
            'CartoDB Voyager Labels Under' => 'CartoDB.VoyagerLabelsUnder',
            'Hike Bike' => 'HikeBike.HikeBike',
        ];
    }
}
