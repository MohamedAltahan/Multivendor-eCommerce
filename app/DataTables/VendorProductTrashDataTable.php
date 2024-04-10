<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\ProductImages;
use App\Models\VendorProductTrash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductTrashDataTable extends DataTable
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
                $deleteBtn = "<a href='" . route('vendor.product.trash.force-delete', $query->id)  . "
                'class='btn btn-sm mx-1 my-1 btn-danger '><i class='fas fa-ban'></i> Delete</a>";
                $restoreBtn = "<a href='" . route('vendor.product.trash.restore', $query->id)  . "
                'class='btn btn-sm mx-1 my-1 btn-success '><i class='fas fa-trash-undo'></i> Restore</a>";
                return $deleteBtn . $restoreBtn;
            })
            ->addColumn('image', function ($query) {
                $productImage = ProductImages::where('product_key', $query->product_key)->first();
                if ($productImage == null) {
                    return 'no image';
                }
                return "<img width='100px' src='" . asset('uploads/' . $productImage->name) . "'></img>";
            })
            ->addColumn('is_approved', function ($query) {
                if ($query->is_approved == 'pending') {
                    return '<i class="badge bg-warning">Pending</i>';
                } elseif ($query->is_approved == 'yes') {
                    return '<i class="badge bg-success">Yes</i>';
                } elseif ($query->is_approved == 'no') {
                    return '<i class="badge bg-danger">No</i>';
                }
            })
            ->addColumn('deleted', function ($query) {
                return Carbon::createFromTimeStamp(strtotime($query->deleted_at))->diffForHumans();
            })
            ->rawColumns(['action', 'image', 'type', 'status', 'is_approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model)
    {
        return $model->onlyTrashed()->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproducttrash-table')
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
            Column::make('is_approved')->width(100),
            // Column::make('image'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(220)
                ->addClass('text-center'),
            Column::make('deleted'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductTrash_' . date('YmdHis');
    }
}
