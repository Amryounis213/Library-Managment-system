<?php

namespace App\DataTables\Drivers;

use App\Models\Driver;
use App\Models\Kindergarten;
use App\Models\Level;
use Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DriversDataTable extends DataTable
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
            ->addColumn('status', function (Driver $model) {
                return view('pages.drivers.parts._status', compact('model'));
            })
            ->editColumn('kindergarten_id', function (Driver $model) {
                return $model->Kindergarten ? $model->Kindergarten->name : '';
            })
            ->addColumn('action', function (Driver $model) {
                return view('pages.drivers.parts._action-menu', compact('model'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Driver $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Driver $model)
    {

        if(Auth::user()->kindergarten_id != null)
        {
            return $model->where('kindergarten_id' , Auth::user()->kindergarten_id)->newQuery();    
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
            Column::make('name')->title(__('name'))->addClass('text-center'), 
            Column::make('mobile')->title(__('mobile'))->addClass('text-center'), 
            Column::make('bus_no')->title('رقم الحافلة')->addClass('text-center'), 

            Column::computed('kindergarten_id')
            ->addClass('text-center')
            ->responsivePriority(-1)
            ->title('الروضة'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-start')
                ->responsivePriority(-1)
                ->title(__('Status')),

              
            Column::computed('action')
                ->exportable(false)
                ->printable(true)
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
