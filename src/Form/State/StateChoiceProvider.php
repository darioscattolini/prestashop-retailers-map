<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\State;

use PrestaShop\PrestaShop\Adapter\Country\CountryDataProvider;
use PrestaShop\PrestaShop\Core\Form\FormChoiceAttributeProviderInterface;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

final class StateChoiceProvider implements 
    FormChoiceProviderInterface, 
    FormChoiceAttributeProviderInterface
{
    /**
     * @var CountryDataProvider
     */
    private $countryDataProvider;

    /**
     * @var int
     */
    private $langId;

    /**
     * @var array
     */
    private $countries;

    /**
     * @param int $langId
     */
    public function __construct(
        $langId, CountryDataProvider $countryDataProvider
    ) {
        $this->langId = $langId;
        $this->countryDataProvider = $countryDataProvider;
    }

    /**
     * @return array
     */
    public function getChoices()
    {
        $countries = $this->getCountries();
        $choices = [];

        foreach ($countries as $country) {
            foreach ($country['states'] as $state) {
                $choices[$state['name']] = $state['id_state'];
            }
        }

        return $choices;
    }

    /**
     * @return array
     */
    public function getChoicesAttributes()
    {
        $countries = $this->getCountries();
        $choicesAttributes = [];

        foreach ($countries as $country) {
            foreach ($country['states'] as $state) {
                $choicesAttributes[$state['name']] = [
                    'country' => $country['id_country']
                ];
            }
        }

        return $choicesAttributes;
    }

    /**
     * @return array
     */
    private function getCountries()
    {
        if (null === $this->countries) {
            $this->countries = $this->countryDataProvider
                ->getCountries($this->langId);
        }

        return $this->countries;
    }
}
