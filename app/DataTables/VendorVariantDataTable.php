<?php

namespace App\DataTables;

use App\Models\ProductVariantType;
use App\Models\Variant;
use App\Models\VendorProuductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorVariantDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.variant.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='" . route('vendor.variant.destroy', $query->id)  . "'class='btn btn-sm mx-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";
                $addBtn = "<a href='" . route('vendor.product.variant-details.index', $query->id)  . "'class='btn btn-sm mx-1 my-1 btn-warning '><i class='fas fa-heart'></i>Add value</a>";

                return $editBtn . $deleteBtn . $addBtn;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $button = '<div class="form-check form-switch">
                        <input checked class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch" >
                        </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                        <input class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch" >
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
    public function query(ProductVariantType $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorvariant-table')
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
            Column::make('id')->width(50),
            Column::make('name')->width(100),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProuductVariant_' . date('YmdHis');
    }
}
