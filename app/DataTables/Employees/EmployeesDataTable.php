<?php

namespace App\DataTables\Employees;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class EmployeesDataTable extends DataTable
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
            ->editColumn('job', function(Employee $model){
                return $model->JobPlacement ? ($model->JobPlacement->Job->name) ?? '---' : '---';
            })
            ->editColumn('active', function (Employee $model) {
                return view('pages.employees.index._status2', compact('model'));
            })
            ->editColumn('period', function (Employee $model) {
                return $model->JobPlacement ? $model->JobPlacement->Period->name ?? '---' : '---';
            })
            ->editColumn('division', function (Employee $model) {
                return $model->JobPlacement ? ($model->JobPlacement->Division->name) ?? '---' : '---';
            })
            ->editColumn('level', function (Employee $model) {
                return $model->JobPlacement ? ($model->JobPlacement->Level->name) ?? '---' : '---';
            })
            ->addColumn('status', function (Employee $model) {
                return view('pages.employees.index._status', compact('model'));
            })
            ->addColumn('action', function (Employee $model) {
                return view('pages.employees.index._action-menu', compact('model'));
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param Employee $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        if(Auth::user()->kindergarten_id != null)
        {
            return $model->whereHas('JobPlacement' , function($query){
                $query->where('kindergarten_id'  , Auth::user()->kindergarten_id);
            })->newQuery();

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
            Column::make('name')->title(__('name'))->addClass('text-center'),
            Column::computed('job')->title('الوظيفة')->addClass('text-center'),
            Column::make('mobile')->title(__('mobile'))->addClass('text-center'),
            Column::make('bth_date')->title(__('dob'))->addClass('text-center'),
            //Column::make('added_by')->title(__('created by'))->addClass('text-center'),
            Column::computed('period')->title('الفترة')->addClass('text-center'),
            Column::computed('division')->title('الشعبة')->addClass('text-center'),
            Column::computed('level')->title('المستوى')->addClass('text-center'),
            Column::computed('active')->title('مفعل')->addClass('text-start'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->responsivePriority(-1)
                ->title(__('Status')),
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
