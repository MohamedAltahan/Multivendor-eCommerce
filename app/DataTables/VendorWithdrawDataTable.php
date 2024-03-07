<?php

namespace App\DataTables;

use App\Models\VendorWithdraw;
use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorWithdrawDataTable extends DataTable
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
                $detailsBtn = "<a href='" . route('vendor.withdraw-request-details.show', $query->id)  . "'class='btn btn-sm btn-primary'><i class='far fa-eye'></i> Details</a>";
                return $detailsBtn;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 'paid') {
                    return "<i class='badge bg-success'>Paid</i>";
                } elseif ($query->status == 'pending') {
                    return "<i class='badge bg-warning'>Pending</i>";
                } else {
                    return "<i class='badge bg-danger'>Declined</i>";
                }
            })
            ->addColumn('total requested amount', function ($query) {
                return getCurrency() . ' ' . $query->total_amount;
            })
            ->addColumn('withdraw_charge', function ($query) {
                return getCurrency() . ' ' . $query->withdraw_charge;
            })
            ->addColumn('net withdraw amount', function ($query) {
                return getCurrency() . ' ' . $query->withdraw_amount;
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawRequest $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorwithdraw-table')
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
            Column::make('method'),
            Column::make('total requested amount'),
            Column::make('withdraw_charge'),
            Column::make('net withdraw amount'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorWithdraw_' . date('YmdHis');
    }
}
