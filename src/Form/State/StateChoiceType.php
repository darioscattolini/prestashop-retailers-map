<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\State;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StateChoiceType extends AbstractType
{
    /**
     * @var StateChoiceProvider
     */
    private $stateChoiceProvider;

    public function __construct(StateChoiceProvider $stateChoiceProvider)
    {
        $this->stateChoiceProvider = $stateChoiceProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = array_merge(
            ['--' => ''],
            $this->stateChoiceProvider->getChoices()
        );

        $resolver->setDefaults(['choices' => $choices]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
