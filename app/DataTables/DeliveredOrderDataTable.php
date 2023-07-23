<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use App\Models\Order;

class DeliveredOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->collection($query)
            ->addColumn('items', function ($row) {
                $data = $row->items->map(function ($item) {
                    return $item->pivot->quantity . "x " . $item->item_name;
                })->implode('<br />');
                return $data;
            })
            ->addColumn('total', function ($row) {
                $data = $row->items->map(function ($item) {
                    return  $item->sellprice * $item->pivot->quantity;
                })->sum();
                return "&#8369;" . $data;
            })
            ->addColumn('created_at', function ($row) {
                return date_format(date_create($row->start_date), "M d, Y");
            })
            ->addColumn('updated_at', function ($row) {
                return date_format(date_create($row->end_date), "M d, Y ");
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<button class="btn btn-danger bi bi-trash3 delete" data-id="' . $row->id . '"></button>';
                return $actionBtn;
            })
            ->rawColumns(['items', 'total', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query()
    {
        $orders = Order::with([
            'items' => function ($query) {
                return $query->select('id', 'item_name', 'sellprice');
            },
            'customer' => function ($query) {
                return $query->select('id', 'customer_name');
            },
            'shipper'  => function ($query) {
                return $query->select('id', 'name');
            },
            'paymentmethod'  => function ($query) {
                return $query->select('id', 'Methods');
            }
        ])->where('status', "Delivered")
            ->orderBy('id', 'ASC')->get();
        return $orders;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('deliveredorder-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->autoWidth(false)
            ->addTableClass('table-bordered')
            ->responsive(true)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->paging(10);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('customer.customer_name')
                ->title('customer'),
            Column::make('items'),
            Column::make('shipper.name')
                ->title('Shipment'),
            Column::make('paymentmethod.Methods')
                ->title('Mode of Payment'),
            Column::make('total')
                ->title('Total Price'),
            // Column::make('status'),
            Column::make('created_at')
                ->title('date placed'),
            Column::make('updated_at')
                ->title('date delivered'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DeliveredOrder_' . date('YmdHis');
    }
}
