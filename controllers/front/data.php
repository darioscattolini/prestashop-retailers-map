<?php

class RetailersMapDataModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        /** @var RetailersMap */
        $module = $this->module;

        $langId = $this->context->language->id;

        $data = $module->getData($langId);
        $retailers = $data['retailers'];
        $groups = $data['groups'];

        $output = [
            'retailers' => $retailers,
            'groups' => $groups,
            'settings' => $this->getMapSettings($data['path']),
        ];

        header('Content-Type: application/json');
        exit(json_encode($output));
    }

    protected function getMapSettings(string $modulePath): array
    { //move to backoffice config and db
        return [
            'mediaPath' => $modulePath.'views/',
            'containerId' => 'retailers-map',
            'defaultCenter' => [40.36418119493289, -3.7638643864609374],
            'defaultZoom' => 6,
            'tileLayer' => [
                'api' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                'options' => [
                    'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    'maxZoom' => 19,
                ],
            ],
        ];
    }
}
