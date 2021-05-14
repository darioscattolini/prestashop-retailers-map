<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Controller\Admin;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use DomainException;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapGroup as Group;
use PrestaShop\Module\RetailersMap\Entity\RetailersmapRetailer as Retailer;
use PrestaShop\Module\RetailersMap\Toolbar\ToolbarDataProvider;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\Builder\FormBuilderInterface;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\Handler\FormHandlerInterface;
use PrestaShop\PrestaShop\Core\Grid\GridFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RetailerController extends CRUDController
{
    public function __construct(
        array $pageData,
        EntityRepository $repository,
        GridFactory $gridFactory,
        FormBuilderInterface $formBuilder,
        FormHandlerInterface $formHandler,
        ToolbarDataProvider $toolbarProvider
    ) {
        parent::__construct(
            $pageData, 
            $repository, 
            $gridFactory, 
            $formBuilder, 
            $formHandler, 
            $toolbarProvider
        );

        $this->specialFormTemplate = '@Modules/retailersmap/views/templates/admin/retailer.form.html.twig';
    }

    /**
     * Create retailer.
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        if (!$this->checkGroupsExistence()) {
            return $this->redirectToRoute($this->route);
        }

        $formOptions = $this->getFormOptions($request);

        $form = $this->formBuilder->getForm([], $formOptions);
        $form->handleRequest($request);

        try {
            $result = $this->formHandler->handle($form);

            if (null !== $result->getIdentifiableObjectId()) {
                $this->addFlash(
                    'success',
                    $this->trans(
                        'Successful creation.', 'Admin.Notifications.Success'
                    )
                );

                return $this->redirectToRoute($this->route);
            }
        } catch (DomainException $e) {
            // SEE MANUFACTURERCONTROLLER.PHP FOR BETTER ERROR HANDLING FOR ALL CONTROLLERS

            $this->addFlash(
                'error',
                $this->trans(
                    'Retailer could not be created', $this->translationDomain
                )
            );

            return $this->redirectToRoute($this->route);
        }

        $formTitle = 'Create new '.$this->pageName;
        $viewParameters = $this->getFormViewParameters($form, $formTitle);

        return $this->render($this->formTemplate, $viewParameters);
    }

    /**
     * Edit retailer.
     *
     * @param int $itemId
     *
     * @return Response
     */
    public function editAction(Request $request, $itemId)
    {
        $itemId = (int) $itemId;

        try {
            /** @var Retailer */
            $retailer = $this->repository->findOneBy(['id' => $itemId]);
            $storedCountryId = $retailer->getIdCountry();

            $formOptions = $this->getFormOptions($request, $storedCountryId);

            try {
                $form = $this->formBuilder->getFormFor(
                    (int) $itemId, [], $formOptions
                );
                $form->handleRequest($request);
                $result = $this->formHandler->handleFor((int) $itemId, $form);

                if ($result->isSubmitted() && $result->isValid()) {
                    $this->addFlash(
                        'success',
                        $this->trans(
                            'Successful update.', 'Admin.Notifications.Success'
                        )
                    );

                    return $this->redirectToRoute($this->route);
                }

                ///** @var EditableManufacturerAddress $editableAddress */   NO ES CLARO QUE HACE ESTO
                //$editableAddress = $this->getQueryBus()->handle(new GetManufacturerAddressForEditing($addressId));
            } catch (DomainException $e) {
                // SEE MANUFACTURERCONTROLLER.PHP FOR BETTER ERROR HANDLING FOR ALL CONTROLLERS
                $this->addFlash(
                    'error',
                    $this->trans(
                        'Retailer could not be updated', 
                        $this->translationDomain
                    )
                );

                return $this->redirectToRoute($this->route);
            }
        } catch (EntityNotFoundException $e) {
            $retailer = null; //###########

            return $this->redirectToRoute($this->route);
        }

        $formTitle = 'Edit '.$this->pageName;
        $viewParameters = $this->getFormViewParameters($form, $formTitle);

        return $this->render($this->formTemplate, $viewParameters);
    }

    /**
     * @return bool
     */
    private function checkGroupsExistence(): bool
    {
        $entityManager = $this->getDoctrine()->getManager();
        $groupsRepository = $entityManager->getRepository(Group::class);
        $groups = $groupsRepository->findAll();
        $amount = count($groups);

        if ($amount === 0) {
            $this->addFlash(
                'warning',
                $this->trans(
                    'At least one group must be created before adding a retailer.',
                    $this->translationDomain
                )
            );

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    private function getFormOptions(
        Request $request,
        ?int $storedCountryId = null
    ): array {
        $countryId = $storedCountryId;

        if (
            $request->request->has('country') 
            /* && isset($request->request->get('country')) */
        ) {
            $countryId = (int) $request->request->get('country');
        }

        $formOptions = [];

        if (null !== $countryId) {
            $formOptions['id_country'] = $countryId;
        }

        return $formOptions;
    }
}
