<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Group;

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class GroupType extends AbstractType
{
    /**
     * @var FormChoiceProviderInterface
     */
    private $markersChoiceProvider;

    public function __construct(
        FormChoiceProviderInterface $markersChoiceProvider
    )
    {
        $this->markersChoiceProvider = $markersChoiceProvider;
    }

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
            ->add('id_marker', ChoiceType::class, [
                'label' => 'Marker',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'help' => 'Specify a marker icon for all group members. ' .
                    'It can be overriden for particular retailers.',
                'required' => false,
                'choices' => $this->markersChoiceProvider->getChoices()
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
