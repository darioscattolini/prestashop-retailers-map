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
        ];

        header('Content-Type: application/json');
        exit(json_encode($output));
    }
}
