<?php

namespace PrestaShop\Module\RetailersMap\Grid\Group;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;

final class GroupGridDefinitionFactory extends AbstractGridDefinitionFactory
{
    private $translationDomain = 'Modules.Retailersmap.Group';

    protected function getId()
    {
        return 'retailers_group';
    }

    protected function getName()
    {
        return $this->trans('Retailers Groups', [], $this->translationDomain);
    }

    protected function getColumns()
    {
        return (new ColumnCollection())
            ->add((new DataColumn('id_group'))
                ->setName($this->trans('ID', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'id_group',
                ])
            )
            ->add((new DataColumn('name'))
                ->setName($this->trans('Name', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'name',
                ])
            )
            ->add((new DataColumn('group_marker'))
                ->setName($this->trans('Marker', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'group_marker',
                ])
            )
            ->add((new DataColumn('group_retina_marker'))
                ->setName(
                    $this->trans('Retina Marker', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'group_retina_marker',
                ])
            )
            ->add((new DataColumn('stack_order'))
                ->setName(
                    $this->trans('Stack Order', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'stack_order',
                ])
            )
            ->add((new ActionColumn('actions'))
                ->setName($this->trans('Actions', [], 'Admin.Global'))
                ->setOptions([
                    'actions' => (new RowActionCollection())
                        ->add((new LinkRowAction('edit'))
                            ->setName(
                                $this->trans('Edit', [], 'Admin.Actions')
                            )
                            ->setIcon('edit')
                            ->setOptions([
                                'route' => 'ps_retailersmap_group_edit',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_group',
                                'clickable_row' => true,
                            ])
                        )
                        ->add((new SubmitRowAction('delete'))
                            ->setName(
                                $this->trans('Delete', [], 'Admin.Actions')
                            )
                            ->setIcon('delete')
                            ->setOptions([
                                'method' => 'POST',
                                'route' => 'ps_retailersmap_group_delete',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_group',
                                'confirm_message' => $this->trans(
                                    'Delete selected item?',
                                    [],
                                    'Admin.Notifications.Warning'
                                ),
                            ])
                        ),
                ])
            );
    }
}
