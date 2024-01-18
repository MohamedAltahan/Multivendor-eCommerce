<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductImages;
use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.products.edit', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='" . route('vendor.products.destroy', $query->id)  . "'class='btn btn-sm mx-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";
                $moreButton = '<a class="btn btn-sm btn-dark" href="' . route('vendor.product-variant.index', ['product_id' => $query->id]) . '"><i class="fas fa-heart"></i>Variant</a>';
                return $editBtn . $deleteBtn . $moreButton;
            })
            ->addColumn('image', function ($query) {
                $productImage = ProductImages::where('product_key', $query->product_key)->first();
                if ($productImage == null) {
                    return 'no image';
                }
                return "<img width='100px' src='" . asset('uploads/' . $productImage->name) . "'></img>";
            })
            ->addColumn('type', function ($query) {
                switch ($query->product_type) {
                    case 'new':
                        return '<i class="badge bg-success">New</i>';
                        break;
                    case 'featured':
                        return '<i class="badge bg-success">Featured</i>';
                        break;
                    case 'top':
                        return '<i class="badge bg-warning">Top</i>';
                        break;
                    case 'best':
                        return '<i class="badge bg-danger">Best</i>';
                        break;
                    default:
                        return '<i class="badge bg-dark">None</i>';
                }
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'active') {
                    $button = '<div class="form-check form-switch">
                        <input checked class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch" id="flexSwitchCheckDefault">
                        </div>';
                } else {
                    $button = '<div class="form-check form-switch">
                        <input class="form-check-input change-status" type="checkbox" data-id="' . $query->id . '" role="switch" id="flexSwitchCheckDefault">
                        </div>';
                }

                return $button;
            })
            ->rawColumns(['action', 'image', 'type', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproduct-table')
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
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('price'),
            Column::make('type')->width(100),
            Column::make('status'),
            // Column::make('image'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
