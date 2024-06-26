<?php

namespace App\DataTables;

use App\Models\VariantDetails;
use App\Models\VendorProductVariantDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorVariantDetailsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('vendor.product.variant-details.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='" . route('vendor.product.variant-details.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 mx-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";

                return $editBtn . $deleteBtn;
            })
            ->addColumn('variant_name', function ($query) {
                return $query->variantType->name;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $button = '<div class="form-check form-switch">
                        <input checked class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch" >
                        </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                        <input class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch">
                        </div>';
                }
                return $button;
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VariantDetails $model): QueryBuilder
    {
        return $model->where('product_variant_type_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductvariantdetails-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
            Column::make('variant_name'),
            Column::make('variant_value'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(180)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductVariantDetails_' . date('YmdHis');
    }
}
