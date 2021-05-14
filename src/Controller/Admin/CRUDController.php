<?php

declare(strict_types=1);

namespace PrestaShop\Module\RetailersMap\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use PrestaShop\Module\RetailersMap\Toolbar\ToolbarDataProvider;
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\Builder\FormBuilderInterface;            //for ad hoc criteria
use PrestaShop\PrestaShop\Core\Form\IdentifiableObject\Handler\FormHandlerInterface;
use PrestaShop\PrestaShop\Core\Grid\GridFactory;
use PrestaShop\PrestaShop\Core\Grid\GridInterface;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteria;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CRUDController extends FrameworkBundleAdminController
{
    /** @var string */
    protected $pageName;

    /** @var string */
    protected $iconName;

    /** @var string */
    protected $route;

    /** @var string */
    protected $translationDomain;

    /** @var EntityRepository */
    protected $repository;

    /** @var GridFactory */
    protected $gridFactory;

    /** @var string */
    protected $gridTemplate = '@Modules/retailersmap/views/templates/admin/grid.html.twig';

    /** @var FormBuilderInterface */
    protected $formBuilder;

    /** @var FormHandlerInterface */
    protected $formHandler;

    /** @var ToolbarDataProvider */
    protected $toolbarProvider;

    /** @var string */
    protected $formTemplate = '@Modules/retailersmap/views/templates/admin/form.html.twig';

    /** @var string|null */
    protected $specialFormTemplate;

    public function __construct(
        array $pageData,
        EntityRepository $repository,
        GridFactory $gridFactory,
        FormBuilderInterface $formBuilder,
        FormHandlerInterface $formHandler,
        ToolbarDataProvider $toolbarProvider
    ) {
        parent::__construct();
        $this->pageName = $pageData['name'];
        $this->iconName = $pageData['icon'];
        $this->route = $pageData['route'];
        $this->translationDomain = 'Modules.Retailersmap.'
            .ucfirst($pageData['name']);
        $this->repository = $repository;
        $this->gridFactory = $gridFactory;
        $this->formBuilder = $formBuilder;
        $this->formHandler = $formHandler;
        $this->toolbarProvider = $toolbarProvider;
    }

    /**
     * List items.
     *
     * @return Response
     */
    public function indexAction()
    {
        $grid = $this->getGrid();
        $gridView = $this->presentGrid($grid);

        $viewParameters = $this->getCommonViewParameters();
        $viewParameters['grid'] = $gridView;
        $viewParameters['customButton'] = $this->getAddButton();

        return $this->render($this->gridTemplate, $viewParameters);
    }

    /**
     * Create item.
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->formBuilder->getForm();
        $form->handleRequest($request);
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

        $formTitle = 'Create new '.$this->pageName;
        $viewParameters = $this->getFormViewParameters($form, $formTitle);

        return $this->render($this->formTemplate, $viewParameters);
    }

    /**
     * Edit item.
     *
     * @param int $itemId
     *
     * @return Response
     */
    public function editAction(Request $request, $itemId)
    {
        $form = $this->formBuilder->getFormFor((int) $itemId);
        $form->handleRequest($request);
        $result = $this->formHandler->handleFor((int) $itemId, $form);

        if ($result->isSubmitted() && $result->isValid()) {
            $this->addFlash(
                'success',
                $this->trans('Successful update.', 'Admin.Notifications.Success')
            );

            return $this->redirectToRoute($this->route);
        }

        $formTitle = 'Edit '.$this->pageName;
        $viewParameters = $this->getFormViewParameters($form, $formTitle);

        return $this->render($this->formTemplate, $viewParameters);
    }

    /**
     * Delete item.
     *
     * @param int $itemId
     *
     * @return Response
     */
    public function deleteAction($itemId)
    {
        // Why is this not delegated to Form Handler??

        /** @var EntityManagerInterface */
        $entityManager = $this->get('doctrine.orm.entity_manager');

        try {
            $item = $this->repository->findOneBy(['id' => $itemId]);
        } catch (EntityNotFoundException $e) {
            $item = null;
        }

        if (null !== $item) {
            $entityManager->remove($item);
            $entityManager->flush();

            $this->addFlash(
                'success',
                $this->trans(
                    'Successful deletion.', 'Admin.Notifications.Success'
                )
            );
        } else {
            $this->addFlash(
                'error',
                $this->trans(
                    'Cannot find %itemType% %itemId%',
                    $this->translationDomain,
                    [
                        '%itemType%' => $this->pageName,
                        '%itemId%' => $itemId,
                    ]
                )
            );
        }

        return $this->redirectToRoute($this->route);
    }

    /**
     * @return array
     */
    protected function getToolbarButtons()
    {
        $toolbarData = $this->toolbarProvider->getDataFor($this->pageName);
        $structuredData = [];

        foreach ($toolbarData as $buttonData) {
            $structuredData[$buttonData->name] = [
                'desc' => $this->trans(
                    $buttonData->descriptionContent,
                    $buttonData->descriptionDomain
                ),
                'icon' => $buttonData->icon,
                'href' => $this->generateUrl($buttonData->route),
            ];
        }

        return $structuredData;
    }

    /**
     * @return GridInterface
     */
    protected function getGrid()
    {
        $searchCriteria = new SearchCriteria(); //ad hoc criteria
        $grid = $this->gridFactory->getGrid($searchCriteria);

        return $grid;
    }

    /**
     * @return array
     */
    protected function getAddButton()
    {
        $desc = 'Add new '.$this->pageName;
        $path = $this->route.'_create';

        return [
            'desc' => $this->trans($desc, $this->translationDomain),
            'icon' => 'add_circle_outline',
            'path' => $path,
        ];
    }

    /**
     * @return array
     */
    protected function getCommonViewParameters()
    {
        return [
            'enableSidebar' => true,
            'layoutTitle' => $this->trans(
                'Retailers Map', 'Modules.Retailersmap.General'
            ),
            'layoutHeaderToolbarBtn' => $this->getToolbarButtons(),
        ];
    }

    /**
     * @return array
     */
    protected function getFormViewParameters(FormInterface $form, string $title)
    {
        $parameters = $this->getCommonViewParameters();
        $parameters['form'] = $form->createView();
        $parameters['formTitle'] = $this->trans(
            $title, $this->translationDomain
        );
        $parameters['formTitleIcon'] = $this->iconName;
        $parameters['cancelPath'] = $this->route;
        $parameters['formFull'] = $form;

        if ($this->specialFormTemplate) {
            $parameters['specialTemplate'] = $this->specialFormTemplate;
        }

        return $parameters;
    }
}
