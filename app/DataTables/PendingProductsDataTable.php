<?php

namespace App\DataTables;

use App\Models\PendingProduct;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

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
            ->addColumn('Approval', function ($query) {

                return "<select class='form-control is_approved' data-id='$query->id'>
                <option value='pending'>Pending</option>
                <option value='yes'>Approved</option>
                </select>";
            })
            ->addColumn('shop_name', function ($query) {
                return $query->vendor->shop_name;
            })
            ->rawColumns(['action', 'image', 'type', 'status', 'Approval'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('is_approved', 'pending')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pendingproducts-table')
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
            Column::make('id')->width(40),
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('shop_name'),
            Column::make('price'),
            Column::make('Approval')->width(100),
            Column::make('type')->width(100),
            Column::make('status')->width(50),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingProducts_' . date('YmdHis');
    }
}
