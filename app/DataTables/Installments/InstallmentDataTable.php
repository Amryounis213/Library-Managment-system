<?php

namespace App\DataTables\Installments;

use App\Models\ChildrenSubscriptions;
use App\Models\Installment;
use App\Models\PayFees;
use App\Models\Subscriptions;
use Illuminate\Cache\RateLimiting\Limit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstallmentDataTable extends DataTable
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
            // ->editColumn('created_by', function (Subscriptions $model) {
            //     return $model->creator ? $model->creator->first_name : __('System');
            // })
            // ->editColumn('subscription_id', function (PayFees $model) {
            //     return $model->Subscription ? $model->Subscription->name : 'غير معرف';
            // })
            ->editColumn('pay_fee', function (Installment $model) {
                return view('pages.installments.parts.pay_fee', compact('model'));
            })
            ->editColumn('year', function (Installment $model) {
                return $model->Year;
            })
            ->addColumn('status', function (Installment $model) {
                return view('pages.installments.parts._status', compact('model'));
            });
            // ->addColumn('action', function (Installment $model) {
            //     return view('pages.installments.parts._action-menu', compact('model'));
            // });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Installment $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Installment $model)
    {
        $children = $this->request()->get('children');
        $year = $this->request()->get('year');
        if(!empty($children))
        {

            if(!empty($year))
            {
                return $model->where('children_id' , $children)->where('year' , $year)->newQuery();

            }

            return $model->where('children_id' , $children)->newQuery();

        }
       
        return $model->where('created_at' , null)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('patients-table')
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

            Column::make('payment_date')->title('تاريخ طلب الدفعة')->addClass('text-center'),
            Column::make('payment_amount')->title('المبلغ المطلوب')->addClass('text-center'),
            Column::computed('year')->title('العام الدراسي')->addClass('text-center'),

           // Column::make('year')->title('العام الدراسي')->addClass('text-center'),

            Column::make('notices')->title('سبب الخصم / ملاحظات')->addClass('text-center'),

            Column::computed('status')->title('الحالة')->addClass('text-center'),
            Column::computed('pay_fee')->title('دفع قسط')->addClass('text-center'),

            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->responsivePriority(-1)
            //     ->title(__('action')),
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
