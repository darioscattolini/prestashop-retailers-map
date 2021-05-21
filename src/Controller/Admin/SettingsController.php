<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Controller\Admin;

use PrestaShop\PrestaShop\Core\Form\FormHandler;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends FrameworkBundleAdminController
{
    /**
     * Loads settings form page.
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        /**
         * @var FormHandler
         */
        $formHandler = $this->get(
            'prestashop.module.retailers_map.form.form_handler.settings'
        );

        /** @var Form $form */
        $form = $formHandler->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SubmitButton $clickedButton */
            $clickedButton = $form->getClickedButton();
            $requestedAction = $clickedButton->getName();

            if ($requestedAction === 'save') {
                return $this->saveSettings($form);
            } else {
                return $this->showPreview($form);
            }
        }

        return $this->renderForm($form);
    }

    /**
     * @param FormInterface $form
     * 
     * @return Response
     */
    private function saveSettings(FormInterface $form): Response {
        $data = $form->getData()['settings'];

        $saveErrors = $this
            ->get(
                'prestashop.module.retailers_map.form.form_handler.settings'
            )
            ->save($data);

            if (0 === count($saveErrors)) {
                $this->addFlash(
                    'success', 
                    $this->trans(
                        'Successful update.', 
                        'Admin.Notifications.Success'
                    )
                );

                return $this->redirectToRoute('ps_retailersmap_settings');
            }

            $this->flashErrors($saveErrors);

            return $this->renderForm($form);
    }

    /**
     * @param FormInterface $form
     * 
     * @return Response
     */
    private function showPreview(FormInterface $form): Response {
        $data = $form->getData()['settings'];
        return new Response(json_encode($data));
    }

    /**
     * @param FormInterface $form
     * 
     * @return Response
     */
    private function renderForm(FormInterface $form): Response {
        return $this->render(
            '@Modules/retailersmap/views/templates/admin/settings.html.twig',
            [
                'enableSidebar' => true,
                'layoutTitle' => $this->trans(
                    'Retailers Map', 'Modules.Retailersmap.General'
                ),
                'layoutHeaderToolbarBtn' => $this->getToolbarButtons(),
                'settingsForm' => $this->getFormView($form),
            ]
        );
    }

    /**
     * @return array[]
     */
    private function getToolbarButtons()
    {
        return [
            'index' => [
                'desc' => $this->trans(
                    'Back to start', 'Modules.Retailersmap.General'
                ),
                'icon' => 'arrow_back',
                'href' => $this->generateUrl('ps_retailersmap_index'),
            ],
            'groups' => [
                'desc' => $this->trans('Groups', 'Modules.Retailersmap.Group'),
                'icon' => 'groups',
                'href' => $this->generateUrl('ps_retailersmap_group'),
            ],
            'retailers' => [
                'desc' => $this->trans(
                    'Retailers', 'Modules.Retailersmap.Retailer'
                ),
                'icon' => 'store',
                'href' => $this->generateUrl('ps_retailersmap_retailer'),
            ],
            'markers' => [
                'desc' => $this->trans(
                    'Markers', 'Modules.Retailersmap.Marker'
                ),
                'icon' => 'edit_location_alt',
                'href' => $this->generateUrl('ps_retailersmap_marker'),
            ],
        ];
    }

    /**
     * Sets children FormView values.
     *
     * @return FormView
     */
    private function getFormView(FormInterface $form)
    {
        $view = $form->createView();
        $children = $view->children['settings']->children;

        foreach ($children as $childName => $child) {
            if ($childName === 'save' || $childName === 'seePreview') continue;
            $child->vars['value'] = $view->vars['value'][$childName];
        }

        return $view;
    }
}
