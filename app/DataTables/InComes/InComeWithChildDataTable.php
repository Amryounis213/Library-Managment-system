<?php

namespace App\DataTables\InComes;

use App\Models\IncomeWithChild;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InComeWithChildDataTable extends DataTable
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
            ->editColumn('name', function (IncomeWithChild $model) {
                return $model->Income ? $model->Income->name : __('System');
            })
            ->editColumn('price', function (IncomeWithChild $model) {
                return $model->price . ' شيكل' ;
            })
            ->editColumn('year', function (IncomeWithChild $model) {
                return $model->Year ? $model->Year->name : __('System');
            })
            ->addColumn('action', function (IncomeWithChild $model) {
                return view('pages.incomewithchildren.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param IncomeWithChild $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(IncomeWithChild $model)
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
            Column::computed('name')->title('اسم الايراد')->addClass('text-center'),
            Column::make('price')->title('رسوم الاشتراك')->addClass('text-center'),
            Column::make('year')->title('العام الدراسي')->addClass('text-center'),
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
