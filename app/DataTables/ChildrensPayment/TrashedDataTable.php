<?php

namespace App\DataTables\ChildrensPayment;

use App\Models\Children;
use App\Models\Employee;
use App\Models\PayFees;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class TrashedDataTable extends DataTable
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
        return datatables()
        ->eloquent($query)
        ->addColumn('table_index', '')
        ->editColumn('children', function (PayFees $model) {
            return $model->Children ? $model->Children->name : '';
        })
        ->addColumn('status', function (PayFees $model) {
            return view('pages.childrenpayment.parts._status', compact('model'));
        })
        ->editColumn('year', function (PayFees $model) {
            return $model->Year->name;
        })
        ->editColumn('action', function (PayFees $model) {
            return view('pages.childrenpayment.parts.restore', compact('model'));
        });
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param PayFees $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PayFees $model)
    {
        // if(Auth::user()->kindergarten_id != null)
        // {
        //     return $model->onlyTrashed()->where('kindergarten_id' , Auth::user()->kindergarten_id)->newQuery();
        // }
        return $model->onlyTrashed()->newQuery();
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
            ->orderBy(0)
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
            Column::computed('children')->title('اسم الطالب')->addClass('text-center'),

            Column::make('payment_date')->title('تاريخ الدفعة')->addClass('text-center'),
            Column::make('payment_amount')->title('المبلغ المدفوع')->addClass('text-center'),
            Column::make('Receipt_number')->title('رقم الوصل')->addClass('text-center'),
            Column::computed('year')->title('العام الدراسي')->addClass('text-center'),
            Column::make('notices')->title('سبب الخصم / ملاحظات')->addClass('text-center'),
 
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
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
        return 'Patients_' . date('YmdHis');
    }
}
