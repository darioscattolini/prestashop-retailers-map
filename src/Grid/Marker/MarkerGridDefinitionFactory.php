<?php

namespace PrestaShop\Module\RetailersMap\Grid\Marker;

use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\LinkRowAction;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\Type\SubmitRowAction;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ImageColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\Factory\AbstractGridDefinitionFactory;

final class MarkerGridDefinitionFactory extends AbstractGridDefinitionFactory
{
    private $translationDomain = 'Modules.Retailersmap.Marker';

    protected function getId()
    {
        return 'marker';
    }

    protected function getName()
    {
        return $this->trans('Markers', [], $this->translationDomain);
    }

    protected function getColumns()
    {
        return (new ColumnCollection())
            ->add((new DataColumn('id_marker'))
                ->setName($this->trans('ID', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'id_marker',
                ])
            )
            ->add((new DataColumn('name'))
                ->setName($this->trans('Name', [], $this->translationDomain))
                ->setOptions([
                    'field' => 'name',
                ])
            )
            ->add((new ImageColumn('icon'))
                ->setName($this->trans('Icon', [], $this->translationDomain))
                ->setOptions([
                    'src_field' => 'file_name_default',
                ])
            )
            ->add((new ImageColumn('retina_icon'))
                ->setName(
                    $this->trans('Retina Icon', [], $this->translationDomain)
                )
                ->setOptions([
                    'src_field' => 'file_name_retina',
                ])
            )
            ->add((new DataColumn('icon_width'))
                ->setName(
                    $this->trans('Icon width', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'icon_width',
                ])
            )
            ->add((new DataColumn('icon_height'))
                ->setName(
                    $this->trans('Icon height', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'icon_height',
                ])
            )
            ->add((new DataColumn('anchor_x'))
                ->setName(
                    $this->trans('Icon tip x-position', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'anchor_x',
                ])
            )
            ->add((new DataColumn('anchor_y'))
                ->setName(
                    $this->trans('Icon tip y-position', [], $this->translationDomain)
                )
                ->setOptions([
                    'field' => 'anchor_y',
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
                                'route' => 'ps_retailersmap_marker_edit',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_marker',
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
                                'route' => 'ps_retailersmap_marker_delete',
                                'route_param_name' => 'itemId',
                                'route_param_field' => 'id_marker',
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
