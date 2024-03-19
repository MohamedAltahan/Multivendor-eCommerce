<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use App\Models\ProductVariantDetails;
use App\Models\Setting;
use App\Models\VendorProductVariantDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantDataTable extends DataTable
{
    public $currency;
    //get currency to be the name of the column
    public function __construct()
    {
        $currency = Setting::first()->currency;
        $currency = 'price' . "(" . strtolower($currency) . ")";
        $this->currency = $currency;
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
                $deleteBtn = "<a href='" . route('vendor.product-variant.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 mx-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";

                return $deleteBtn;
            })
            ->addColumn('variant_name', function ($query) {
                return $query->type->name;
            })
            ->addColumn('Variant value', function ($query) {
                return $query->values->variant_value;
            })
            ->addColumn("$this->currency", function ($query) {
                return $query->variant_price;
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
            ->rawColumns(['action', 'status', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('product_id', $this->productId)->orderBy('product_variant_type_id')->newQuery();
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
            Column::make('Variant value'),
            Column::make("$this->currency"),
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
