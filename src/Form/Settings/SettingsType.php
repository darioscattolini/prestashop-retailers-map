<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                'help' => 'Provider of geographical content of map. They may have different map styles, languages and response times.',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'choices' => $this->getTilesProviderChoices(),
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'translation_domain' => 'Admin.Actions',
                'attr' => ['class' => 'btn btn-primary ml-3']
            ])
            ->add('seePreview', SubmitType::class, [
                'label' => 'See preview',
                'translation_domain' => 'Modules.Retailersmap.Settings',
                'attr' => ['class' => 'btn btn-primary ml-3']
            ]);
    }

    /**
     * @return array
     */
    private function getTilesProviderChoices(): array {
        return [
            'OpenStreetMap Mapnik' => 'OpenStreetMap.Mapnik',
            'OpenStreetMap Deutsch' => 'OpenStreetMap.DE',
            'OpenStreetMap Switzerland' => 'OpenStreetMap.CH',
            'OpenStreetMap Français' => 'OpenStreetMap.France',
            'Humanitarian OpenStreetMap Team' => 'OpenStreetMap.HOT',
            'OpenStreetMap Breizh' => 'OpenStreetMap.BZH',
            'Stadia Alidade Smooth' => 'Stadia.AlidadeSmooth',
            'Stadia Alidade Smooth Dark' => 'Stadia.AlidadeSmoothDark',
            'Stadia OSM Bright' => 'Stadia.OSMBright',
            'Stadia Outdoors' => 'Stadia.Outdoors',
            'CyclOSM' => 'CyclOSM',
            'Stamen Toner' => 'Stamen.Toner',
            'Stamen TonerLite' => 'Stamen.TonerLite',
            'Esri World Street Map' => 'Esri.WorldStreetMap',
            'Esri DeLorme' => 'Esri.DeLorme',
            'Esri World TopoMap' => 'Esri.WorldTopoMap',
            'CartoDB Positron' => 'CartoDB.Positron',
            'CartoDB Voyager' => 'CartoDB.Voyager',
            'CartoDB Voyager Labels Under' => 'CartoDB.VoyagerLabelsUnder',
            'Hike Bike' => 'HikeBike.HikeBike',
        ];
    }
}
