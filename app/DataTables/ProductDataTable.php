<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.products.edit', $query->id) . "'class='btn btn-sm btn-primary'><i class='far fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='" . route('admin.products.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";
                $variantButton = "<a href='" . route('admin.product-variant.index', ['productId' => $query->id]) . "'class='btn btn-sm btn-success my-1 mx-1'><i class='fas fa-plus'></i> Add variant</a>";
                return $editBtn . $deleteBtn . $variantButton;
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
                        return '<i class="badge badge-success">New</i>';
                        break;
                    case 'featured':
                        return '<i class="badge badge-success">Featured</i>';
                        break;
                    case 'top':
                        return '<i class="badge badge-warning">Top</i>';
                        break;
                    case 'best':
                        return '<i class="badge badge-danger">Best</i>';
                        break;
                    default:
                        return '<i class="badge badge-dark">None</i>';
                }
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
            ->rawColumns(['action', 'image', 'type', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::guard('admin')->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('image'),
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
        return 'Product_' . date('YmdHis');
    }
}
