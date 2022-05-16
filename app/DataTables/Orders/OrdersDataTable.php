<?php

namespace App\DataTables\Orders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $roleId = Auth::guard()->user()->role_id;
        $userId = Auth::guard()->user()->id;
        $result = $query->whereDate('booking_time', Carbon::today());
        if ($roleId == 9) {
            $result = $query->where('doctor_id', $userId)->orderBy('status', 'asc')->orderBy('id', 'desc');
        }
        if ($roleId == 10) {
            $result = $query->where('in_pharmacy', 1)->where('status', '>', 1);
        }
        if ($roleId == 11) {
            $result = $query->whereBetween('status', [3, 4]);
            // $result = orderTotal($result);
        }
        if ($roleId == 12) {
            $result = $query->where('in_lab', 1)->where('status', '>', 1);
        }
        if ($roleId == 13) {
            $result = $query->where('in_xray', 1)->where('status', '>', 1);
        }
        return datatables()
            ->eloquent($result)
            ->addColumn('table_index', '')
            ->editColumn('created_by', function (Order $model) {
                return $model->creator ? $model->creator->first_name : __('System');
            })
            ->editColumn('doctor_id', function (Order $model) {
                return $model->doctor ? $model->doctor->name : '';
            })
            ->editColumn('clinic_id', function (Order $model) {
                return $model->clinic ? $model->clinic->name : '';
            })
            ->editColumn('created_at', function (Order $model) {
                return $model->created_at->format('d M, Y H:i');
            })
            ->addColumn('status', function (Order $model) {
                return view('pages.order.index._status', compact('model'));
            })
            ->addColumn('action', function (Order $model) {
                return view('pages.order.index._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->responsive()
            ->autoWidth(false)
            ->parameters(['scrollX' => true])
            ->languageSearch('بحث:  ')
            ->languageProcessing('جاري تحميل البيانات ...')
            ->languageZeroRecords('لا يوجد بيانات')
            ->languageInfo("عرض _START_ إلى _END_ من _TOTAL_ ملفات")
            ->languageInfoEmpty("عرض 0 الى 0 من 0 ملفات")
            ->languageInfoFiltered(" | تصفية من _MAX_ اجمالي ملفات")
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('table_index')->title(__('#'))->addClass('text-center'),
            Column::make('identity')->title(__('identity')),
            Column::make('no')->title(__('patient_order')),
            Column::make('name')->title(__('name')),
            Column::make('clinic_id')->title(__('Clinic')),
            Column::make('doctor_id')->title(__('doctor')),
            Column::make('booking_time')->title(__('Reservation date')),
            Column::make('next_visit_date')->title(__('next_visit_date')),
//            Column::make('created_at')
//                ->title(__('created at'))
//                ->addClass('text-center')
//                ->addClass('td-ltr'),
            Column::make('status')->title(__('status'))->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
