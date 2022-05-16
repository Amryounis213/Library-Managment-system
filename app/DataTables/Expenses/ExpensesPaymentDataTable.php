<?php

namespace App\DataTables\Expenses;

use App\Models\ChildrenSubscriptions;
use App\Models\ExpensePay;
use Illuminate\Cache\RateLimiting\Limit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpensesPaymentDataTable extends DataTable
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
            ->editColumn('expense_id', function (ExpensePay $model) {
                return $model->Expense ? $model->Expense->name : 'no';
            })
            ->addColumn('status', function (ExpensePay $model) {
                return view('pages.expense-pay.parts._status', compact('model'));
            })
            ->editColumn('year', function (ExpensePay $model) {
                return $model->Year->name;
            })
            ->editColumn('action', function (ExpensePay $model) {
                return view('pages.expense-pay.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param ExpensePay $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpensePay $model)
    {
        
        $year = $this->request()->get('year');
        if(!empty($year))
        {
            return $model->where('year' , $year)->newQuery();
        }
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
            Column::computed('expense_id')->title('نوع المصروف')->addClass('text-center'),
            Column::make('rec_name')->title('اسم المستلم')->addClass('text-center'),
            Column::make('payment_date')->title('(المصروف)تاريخ الدفعة')->addClass('text-center'),
            Column::make('payment_amount')->title('(المصروف) المبلغ المدفوع')->addClass('text-center'),
            Column::make('Receipt_number')->title('رقم الوصل')->addClass('text-center'),
            Column::make('notices')->title('ملاحظات')->addClass('text-center'),
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
