<?php

namespace App\DataTables\Subscriptions;

use App\Models\YearSubscriptions;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class YearSubscriptionsDataTable extends DataTable
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
            ->editColumn('name', function (YearSubscriptions $model) {
                return $model->Subscription ? $model->Subscription->name : __('System');
            })
            ->editColumn('static_fee', function (YearSubscriptions $model) {
                return view('pages.yearsubscriptions.parts.static_fee', compact('model'));
            })
            ->addColumn('action', function (YearSubscriptions $model) {
                return view('pages.yearsubscriptions.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param YearSubscriptions $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(YearSubscriptions $model)
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
            Column::computed('name')->title('اسم الاشتراك')->addClass('text-center'),
            Column::make('price')->title('رسوم الاشتراك')->addClass('text-center'),
            Column::make('year')->title('العام الدراسي')->addClass('text-center'),

            Column::make('static_fee')->title('رسوم ثابثة')->addClass('text-emd'),
            
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
