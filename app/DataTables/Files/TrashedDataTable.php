<?php

namespace App\DataTables\Divisions;

use App\Models\Children;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Father;
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
        ->editColumn('level', function (Division $model) {
            return $model->Level ? ($model->Level->name) ?? '---' : '---';
        })
        ->editColumn('kindergarten', function (Division $model) {
            return $model->Kindergarten ? ($model->Kindergarten->name) ?? '---' : '---';
        })
        ->editColumn('children_count', function (Division $model) {
            return $model->Children ? ($model->Children->count()) ?? '---' : '---';
        })
        ->addColumn('status', function (Division $model) {
            return view('pages.divisions.parts._status', compact('model'));
        })
        ->addColumn('action', function (Division $model) {
            return view('pages.divisions.parts.restore', compact('model'));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Children $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Division $model)
    {
        if(Auth::user()->kindergarten_id != null)
        {
            return $model->where('kindergarten_id' , Auth::user()->kindergarten_id)->onlyTrashed()->newQuery();
        }
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
            Column::make('name')->title(__('name'))->addClass('text-center'), 
            Column::computed('level')->title('المستوى')->addClass('text-center'),
            Column::computed('kindergarten')->title('الروضة')->addClass('text-center'),
            Column::computed('children_count')->title('عدد الطلاب')->addClass('text-center'),
            Column::make('max_children')->title('السعة')->addClass('text-center'),

            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->responsivePriority(-1)
                ->title(__('Status')),
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
        return 'Patients_' . date('YmdHis');
    }
}
