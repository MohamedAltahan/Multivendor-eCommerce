<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
                $editBtn = "<a href='" . route('admin.order.show', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-eye'></i>Details</a>";
                $deleteBtn = "<a href='" . route('admin.order.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-danger delete-item'><i class='fas fa-trash'></i>Delete</a>";
                $statusBtn = "<a href='" . route('admin.product-variant.destroy', $query->id)  . "'class='btn btn-sm ml-1 my-1 btn-warning delete-item'><i class='fas fa-truck'></i></a>";

                return $editBtn . $deleteBtn . $statusBtn;
            })
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('price', function ($query) {
                return $query->currency . $query->final_total;
            })
            ->addColumn('date', function ($query) {
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status == 'completed') {
                    return "<i class='badge bg-success'>completed</i>";
                } else {
                    return "<i class='badge bg-danger'>pending</i>";
                }
            })
            ->rawColumns(['action', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('date'),
            Column::make('product_quantity'),
            Column::make('price'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::make('payment_method'),
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
        return 'Order_' . date('YmdHis');
    }
}
