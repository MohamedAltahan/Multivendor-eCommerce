<?php

namespace App\DataTables;

use App\Models\Setting;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingRuleDataTable extends DataTable
{
    protected $currency = '';

    public function __construct()
    {
        $this->currency = Setting::first()->currency;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.shipping-rule.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='" . route('admin.shipping-rule.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $button = '<label class="custom-switch mt-2">
                        <input checked type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="change-status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                } else {
                    $button = '<label class="custom-switch mt-2">
                        <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="change-status custom-switch-input ">
                        <span class="custom-switch-indicator"></span>
                      </label>';
                }

                return $button;
            })
            ->addColumn('type', function ($query) {
                switch ($query->type) {
                    case 'flat_cost':
                        return '<i class="badge badge-dark">Fixed cost</i>';
                        break;
                    case 'min_cost':
                        return '<i class="badge badge-success">Depends on order</i>';
                        break;
                }
            })
            ->addColumn('cost', function ($query) {

                return $this->currency . $query->cost;
            })
            ->addColumn('order cost', function ($query) {
                if ($query->min_cost) {
                    return $this->currency . $query->min_cost;
                } else {
                    return '-';
                }
            })
            ->rawColumns(['action', 'status', 'type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shippingrule-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('type'),
            Column::make('order cost'),
            Column::make('cost'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ShippingRule_' . date('YmdHis');
    }
}
