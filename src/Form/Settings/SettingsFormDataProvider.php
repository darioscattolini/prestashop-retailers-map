<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Form\Settings;

use PrestaShop\Module\RetailersMap\Database\Settings;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

class SettingsFormDataProvider implements FormDataProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return Settings::getInstance()->getSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        return Settings::getInstance()->updateSettings($data);
    }
}
