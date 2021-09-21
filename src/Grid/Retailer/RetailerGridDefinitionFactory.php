<?php

namespace PrestaShop\Module\RetailersMap\Grid\Retailer;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ImageColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;

final class RetailerGridDefinitionFactory extends AbstractGridDefinitionFactory
{
    private $translationDomain = 'Modules.Retailersmap.Retailer';

    protected function getId()
    {
        return 'retailer';
    }

    protected function getName()
    {
        return $this->trans('Retailers', [], $this->translationDomain);
    }

    protected function getColumns()
    {
        return (new ColumnCollection())
            ->add((new DataColumn('id_retailer'))
                ->setName($this->trans('ID', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'id_retailer',
                ])
            )
            ->add((new DataColumn('name'))
                ->setName($this->trans('Name', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'name',
                ])
            )
            ->add((new DataColumn('address'))
                ->setName($this->trans('Address', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'address',
                ])
            )
            ->add((new DataColumn('postcode'))
                ->setName(
                    $this->trans('Postcode', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'postcode',
                ])
            )
            ->add((new DataColumn('city'))
                ->setName($this->trans('City', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'city',
                ])
            )
            ->add((new DataColumn('state'))
                ->setName($this->trans('State', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'state',
                ])
            )
            ->add((new DataColumn('country'))
                ->setName($this->trans('Country', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'country',
                ])
            )
            ->add((new DataColumn('latitude'))
                ->setName(
                    $this->trans('Latitude', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'latitude',
                ])
            )
            ->add((new DataColumn('longitude'))
                ->setName(
                    $this->trans('Longitude', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'longitude',
                ])
            )
            ->add((new DataColumn('phone'))
                ->setName($this->trans('Phone', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'phone',
                ])
            )
            ->add((new DataColumn('email'))
                ->setName($this->trans('Email', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'email',
                ])
            )
            ->add((new DataColumn('group'))
                ->setName($this->trans('Group', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'group_name',
                ])
            )
            ->add((new DataColumn('marker'))
                ->setName($this->trans('Marker', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'marker_name',
                ])
            )
            ->add((new DataColumn('active'))  // Should be ToggleColumn, but it would require change in controller
                ->setName($this->trans('Active', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'active',
                ])
            )
            ->add((new ActionColumn('actions'))
                ->setName($this->trans('Actions', [], 'Admin.Global'))
                ->setOptions([
                    'actions' => (new RowActionCollection())
                        ->add((new LinkRowAction('edit'))
                            ->setName($this->trans('Edit', [], 'Admin.Actions'))
                            ->setIcon('edit')
                            ->setOptions([
                                'route' => 'ps_retailersmap_retailer_edit',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_retailer',
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
                                'route' => 'ps_retailersmap_retailer_delete',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_retailer',
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
