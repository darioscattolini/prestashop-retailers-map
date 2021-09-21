<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Retailer;

use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RetailerType extends AbstractType
{
    /**
     * @var array
     */
    private $countryChoices;

    /**
     * @var ConfigurableFormChoiceProviderInterface
     */
    private $statesChoiceProvider;

    /**
     * @var FormChoiceProviderInterface
     */
    private $groupsChoiceProvider;

    /**
     * @var FormChoiceProviderInterface
     */
    private $markersChoiceProvider;

    /**
     * @var int
     */
    private $contextCountryId;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param int $contextCountryId
     */
    public function __construct(
        array $countryChoices,
        ConfigurableFormChoiceProviderInterface $statesChoiceProvider,
        FormChoiceProviderInterface $groupsChoiceProvider,
        FormChoiceProviderInterface $markersChoiceProvider,
        $contextCountryId,
        TranslatorInterface $translator
    ) {
        $this->countryChoices = $countryChoices;
        $this->statesChoiceProvider = $statesChoiceProvider;
        $this->groupsChoiceProvider = $groupsChoiceProvider;
        $this->markersChoiceProvider = $markersChoiceProvider;
        $this->contextCountryId = $contextCountryId;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$countryId = array_key_exists('country_id', $options) ? $options['country_id'] : $this->contextCountryId;
        //$countryId = 0 !== $options['country_id'] ? $options['country_id'] : $this->contextCountryId;
        $data = $options['data'];
        if (array_key_exists('id_country', $data)) {
            $countryId = $data['id_country'];
        }

        $builder
            ->add('name', TextType::class, [
                'label' => 'Retailer\'s name',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'attr' => ['maxlength' => '255'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 64]),
                ],
            ])
            ->add('id_country', ChoiceType::class, [
                'label' => 'Country',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'attr' => ['class' => 'js-retailer-country-select',],
                'choices' => $this->countryChoices,
                'constraints' => [new Assert\NotBlank([
                    'message' => $this->translator->trans(
                        'This field cannot be empty', 
                        [], 
                        'Admin.Notifications.Error'
                    ),
                ])],
            ])
            ->add('id_state', ChoiceType::class, [
                'label' => 'State',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => false,
                'empty_data' => '',
                'choices' => $this->statesChoiceProvider->getChoices([
                    'id_country' => $countryId,
                ]),
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'attr' => ['maxlength' => '64'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 64]),
                ],
            ])
            ->add('postcode', TextType::class, [
                'label' => 'Postcode',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'attr' => ['maxlength' => '12'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 12]),
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'help' => 'Include at least street name and number',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'attr' => ['maxlength' => '255'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 255]),
                ],
            ])
            ->add('latitude', TextType::class, [
                'label' => 'Latitude',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'help' => 'Include at least 5 decimal digits ',
                'required' => true,
                'attr' => ['maxlength' => '11'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 11]),
                ],
            ])
            ->add('longitude', TextType::class, [
                'label' => 'Longitude',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'help' => 'Include at least 5 decimal digits ',
                'required' => true,
                'attr' => ['maxlength' => '11'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 11]),
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => false,
                'attr' => ['maxlength' => '16'],
                'constraints' => [new Assert\Length(['max' => 16])],
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => false,
                'attr' => ['maxlength' => '255'],
                'constraints' => [new Assert\Length(['max' => 255])],
            ])
            ->add('id_group', ChoiceType::class, [
                'label' => 'Group',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'help' => 'Select the group in which this retailer will be included',
                'required' => true,
                'choices' => $this->groupsChoiceProvider->getChoices(),
                'constraints' => [new Assert\NotBlank([
                    'message' => $this->translator->trans(
                        'This field cannot be empty', 
                        [], 
                        'Admin.Notifications.Error'
                    ),
                ])],
            ])
            ->add('id_marker', ChoiceType::class, [
                'label' => 'Marker',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'help' => 'Overrides group marker with a retailer-specific icon file. ' . 
                    'Markers must be previously created in Markers tab',
                'required' => false,
                'choices' => $this->markersChoiceProvider->getChoices()
            ])
            ->add('active', SwitchType::class, [
                'label' => 'Active',
                'help' => 'Inactive retailers remain stored in database but are not displayed in map',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => true,
                'constraints' => [
                    new Assert\NotNull(),
                    new Assert\Type(['type' => 'bool']),
                ],
            ]);

        $modifyStatesField = function (
            FormInterface $form, int $country = null
        ) {
            $states = null === $country
                ? []
                : $this->statesChoiceProvider
                    ->getChoices(['id_country' => $country]);

            $form->add('id_state', ChoiceType::class, [
                'label' => 'State',
                'translation_domain' => 'Modules.Retailersmap.Retailer',
                'required' => false,
                'empty_data' => '',
                'choices' => $states,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($modifyStatesField) {
                $form = $event->getForm();
                $country = $event->getData()['id_country'];
                $modifyStatesField($form, $country);
            }
        );

        $builder->get('id_country')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($modifyStatesField) {
                $form = $event->getForm()->getParent();
                $country = $event->getForm()->getData();
                $modifyStatesField($form, $country);
            }
        );

        $builder->get('id_country')
            ->addModelTransformer(new CallbackTransformer('strval', 'intval'));

        $builder->get('id_state')
            ->addModelTransformer(new CallbackTransformer('strval', 'intval'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'id_country' => $this->contextCountryId,
                'active' => true,
            ])
            ->setAllowedTypes('id_country', 'integer');
    }
}
