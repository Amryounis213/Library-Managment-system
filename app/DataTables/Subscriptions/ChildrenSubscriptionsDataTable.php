<?php

namespace App\DataTables\Subscriptions;

use App\Models\ChildrenSubscriptions;
use App\Models\Subscriptions;
use Illuminate\Cache\RateLimiting\Limit;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ChildrenSubscriptionsDataTable extends DataTable
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
            ->editColumn('subscription_id', function (ChildrenSubscriptions $model) {
                return $model->Subscription ? $model->Subscription->name : 'غير معرف';
            })
            ->editColumn('year', function (ChildrenSubscriptions $model) {
                return $model->Year ? $model->Year->name : 'غير معرف';
            })
            ->editColumn('notices', function (ChildrenSubscriptions $model) {
                return $model->notices ? $model->notices : '---';
            })
            ->addColumn('status', function (ChildrenSubscriptions $model) {
                return view('pages.childrensubscriptions.parts._status', compact('model'));
            })
            ->addColumn('action', function (ChildrenSubscriptions $model) {
                return view('pages.childrensubscriptions.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param ChildrenSubscriptions $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ChildrenSubscriptions $model)
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
            Column::computed('subscription_id')->title('نوع الاشتراك')->addClass('text-center'),
            Column::computed('year')->title('السنة الدراسية')->addClass('text-center'),

            Column::make('required_amount')->title('المبلغ الافتراضي')->addClass('text-center'),
            Column::make('discount')->title('نسبة الخصم')->addClass('text-center'),
            Column::make('total')->title('المبلغ المطلوب')->addClass('text-center'),
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
